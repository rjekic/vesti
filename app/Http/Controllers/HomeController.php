<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Oglasi;
use App\slikeOglasi;
use App\KategorijaOglaci;
use App\Dogadjaji;
use Illuminate\Support\Facades\Validator;
use App\Repository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	private $perpage; 
	private $descoglasi = 'slikeoglasi';
	private $descdogadjaji = 'slikedogadjaji';
	 
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	private function input($data){

		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;
	}
	
	private function moveslike($slika,$oglas_id,$desc){
		
			$file = $slika;
			$filename = $oglas_id."_".time()."_".str_replace(" ", "", $file->getClientOriginalName() );
			$file->move($desc,$filename);

		return $filename;
	}

    public function index()
    {
		if(Auth::user()->role == 'dogadjaji') {
            $res = Dogadjaji::where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($this->perpage);
			return view('dogadjaji.home',['dogadjaji'=>$res, 'search'=>""]);
        }
		$res = Oglasi::with('slike')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($this->perpage);
        return view('oglasi.home',['oglasi'=>$res, 'search'=>""]);
    }
	public function homesearchOglasi(Request $request){
		
		
		$search = $request->input('search');

		$res = Oglasi::where("naslov", "LIKE",'%'.$search.'%')
		->orwhere("text", "LIKE",'%'.$search.'%')
		->orderBy('id', 'DESC')->paginate($this->perpage);

		return view('oglasi.home', ['oglasi' => $res,'search'=>$search]);
  
	}
	
	public function novioglas()
    {
		$user = Auth::user();
		$kategorija = KategorijaOglaci::all();
        return view('oglasi.novioglas',['user'=>$user,'kategorija'=>$kategorija]);
    }
	
	public function createOglas(Request $request){
		
		$data = $request->all();
	
		$validator = Validator::make($data, [
            'naslov' => 'required|string|max:255|min:3',
			'text' => 'required|string|min:10',      
			'cena' => 'required|string',
			'telefon' => 'required|string|min:4',
			'naslovnaslika' => 'mimes:jpeg,jpg,png|max:20000',
			'josslika' => 'array|max:4',
			'josslika.*' => 'mimes:jpeg,jpg,png|max:20000',
        ]);
		$attributeNames = array(
		   'naslov' => 'Naslov',
		   'text' => 'Tekst oglasa',
		   'cena' => 'Cena',
		   'telefon' => 'Telefon',
		   'naslovnaslika' => 'Naslovna slika',
		   'josslika' => 'Dodati još slika',
		   'josslika.*' => 'Dodati još slika',
		   );
		   
		$validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return back()->with(["errors" => $validator->errors()->all()]);
        }
		
		$oglas = Oglasi::create([
			'user_id' => Auth::user()->id,
			'naslov' => $this->input($data['naslov']),
            'text' => $this->input($data['text']),      
			'kategorija' => $data['kategorija'],
			'cena' => $this->input($data['cena']),
			'telefon' => $this->input($data['telefon'])
		]);
		
		if(!empty($data['naslovnaslika'])){
			$slikenalsovna = slikeOglasi::create([
				'user_id' => Auth::user()->id,
				'oglasi_id' => $oglas->id,
				'slika' => $this->moveslike($data['naslovnaslika'],$oglas->id,$this->descoglasi),
				'tip' => 'naslovna'
			]);	
		}
		
		if(!empty($data['josslika'])){
			foreach($data['josslika'] as $osl){
				$slikenalsovna = slikeOglasi::create([
					'user_id' => Auth::user()->id,
					'oglasi_id' => $oglas->id,
					'slika' => $this->moveslike($osl,$oglas->id,$this->descoglasi),
					'tip' => 'ostale'
				]);
			}
		}
		
		return back()->with("message","Uspešno ste kreirali oglas");
	}

	public function deleteoglas($id)
    {
	
		$oglas = Oglasi::findOrFail($id);
		$user = Auth::user();
		if($oglas->user_id == $user->id){
			
			$slike = slikeOglasi::where('oglasi_id',$id)->get();
			foreach($slike as $slika){
				if(file_exists($this->descoglasi.'/'.$slika->slika)) {
					unlink($this->descoglasi.'/'. $slika->slika); 
				}
			}
			slikeOglasi::where('oglasi_id',$id)->delete();
			
			$oglas->delete();
		}
		return back()->with("message", "Uspešno ste obrisali oglas");
    }
	
	/* Dogadjaji */
	/*
	public function homedogadjajisearch(){
		
		$res = Oglasi::with('slike')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->paginate($this->perpage);
        return view('oglasi.home',['oglasi'=>$res, 'search'=>""]);
	}
*/
	public function homedogadjajisearch(Request $request){
		
		
		$search = $request->input('search');

		$res = Dogadjaji::where("naslov", "LIKE",'%'.$search.'%')
		->orwhere("text", "LIKE",'%'.$search.'%')
		->orwhere("datum", "LIKE",'%'.$search.'%')
		->orderBy('id', 'DESC')->paginate($this->perpage);

		return view('dogadjaji.home', ['dogadjaji' => $res,'search'=>$search]);
	}
	
	public function novidogadjaj()
    {
		$user = Auth::user();
        return view('dogadjaji.novidogadjaj',['user'=>$user]);
    }
	
	public function createdogadjaj(Request $request){
		
		$data = $request->all();
		
		$data['datum'] = date('d.m.Y H:i', strtotime($data['datum']));
	
		$validator = Validator::make($data, [
            'naslov' => 'required|string|max:255|min:3',
			'text' => 'required|string|min:10',      
			'datum' => 'date|required|after:'.date("d.m.Y H:i"),
			'telefon' => 'required|string|min:4',
			'slika' => 'mimes:jpeg,jpg,png|max:20000',
        ]);
		$attributeNames = array(
		   'naslov' => 'Naslov',
		   'text' => 'Tekst dogadjaja',
		   'datum' => 'Datum dogadjaja',
		   'telefon' => 'Telefon',
		   'slika' => 'Naslovna slika',
		   );
		   
		$validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return back()->with(["errors" => $validator->errors()->all()]);
        }
		
		$oglas = Dogadjaji::create([
			'user_id' => Auth::user()->id,
			'naslov' => $this->input($data['naslov']),
            'text' => $this->input($data['text']),      
			'slika' => $this->moveslike($data['slika'],Auth::user()->id,$this->descdogadjaji),
			'datum' => $this->input($data['datum']),
			'telefon' => $this->input($data['telefon'])
		]);
		
		return back()->with("message","Uspešno ste kreirali dogadjaj");
	}
	
	
	public function obrisidogadjaj($id)
    {
	
		$dogadjaj = Dogadjaji::findOrFail($id);
		$user = Auth::user();
		if($dogadjaj->user_id == $user->id){
		
			if(file_exists($this->descdogadjaji.'/'.$dogadjaj->slika)) {
				unlink($this->descdogadjaji.'/'. $dogadjaj->slika); 
			}
		
			$dogadjaj->delete();
		}
		return back()->with("message", "Uspešno ste obrisali dogadjaj");
    }
	
}
