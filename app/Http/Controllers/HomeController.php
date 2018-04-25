<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Oglasi;
use App\slikeOglasi;
use App\KategorijaOglaci;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
	private $perpage; 
	 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
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
			'ostaleslike.*' => 'mimes:jpeg,jpg,png|max:20000',
        ]);

        if ($validator->fails()) {
            return back()->with(["errors" => $validator->errors()->all()]);
        }

		
		$oglas = Oglasi::create([
			'user_id' => Auth::user()->id,
			'naslov' => $data['naslov'],
            'text' => $data['text'],      
			'kategorija' => $data['kategorija'],
			'cena' => $data['cena'],
			'telefon' => $data['telefon']
		]);
		if(!empty($data['naslovnaslika'])){
			$slikenalsovna = slikeOglasi::create([
				'user_id' => Auth::user()->id,
				'oglasi_id' => $oglas->id,
				'slika' => $this->moveslike($data['naslovnaslika'],$oglas->id),
				'tip' => 'naslovna'
			]);	
		}
		
		if(!empty($data['ostaleslike'])){

			foreach($data['ostaleslike'] as $osl){
				
				$slikenalsovna = slikeOglasi::create([
						'user_id' => Auth::user()->id,
						'oglasi_id' => $oglas->id,
						'slika' => $this->moveslike($osl,$oglas->id),
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
				if(file_exists('slikeoglasi/'.$slika->slika)) {
					unlink('slikeoglasi/' . $slika->slika); 
				}
			}
			slikeOglasi::where('oglasi_id',$id)->delete();
			
			$oglas->delete();
		}
		return back()->with("message", "Uspešno ste obrisali oglas");
    }
	private function moveslike($slika,$oglas_id){
		
			$file = $slika;
			$filename = $oglas_id."_".time()."_".str_replace(" ", "", $file->getClientOriginalName() );
			$file->move('slikeoglasi',$filename);

		return $filename;
	}
}
