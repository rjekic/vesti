<?php

namespace App\Http\Controllers;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;
use App\Vesti;
use App\Oglasi;
use App\slikeOglasi;

class WelcomeController extends Controller
{
	private $perpage = 9;
	private $temperatura, $slika;

     public function index()
    {
		$this->getWeather();
		$vesti = Vesti::orderBy('datum', 'DESC')->paginate($this->perpage);
		return view('welcome',['vesti' => $vesti,'search'=>"", 'ticker' => $vesti, 'temperatura' => $this->temperatura, 'slika' => $this->slika ]);

    }

	public function search(Request $request)
    {

		$search = $request->input('search');

		$vesti = Vesti::where("naslov", "LIKE",'%'.$search.'%')
		->orwhere("text", "LIKE",'%'.$search.'%')
		->orwhere("datum", "LIKE",'%'.$search.'%')
		->orwhere("izvor", "LIKE",'%'.$search.'%')
		->orderBy('datum', 'DESC')->paginate($this->perpage);

		//ovu su najnovije vesti ya sidebar, da pretraga ne bi uticala na njih
		$newsticker = Vesti::orderBy('datum', 'DESC')->paginate($this->perpage);
		$this->getWeather();
		
		return view('welcome', ['vesti' => $vesti,'search'=>$search, 'ticker' => $newsticker, 'temperatura' => $this->temperatura, 'slika' => $this->slika]);
    }
	
	private function getWeather(){
		$vreme = file_get_contents('https://www.weather2umbrella.com/vremenska-prognoza-valjevo-serbia-sr/trenutno');
		$temperatura = $this->getContents($vreme,'<div class="current_temperature_data', '</div>');
		$temperatura = $this->getContents($temperatura[0],'>', '</p>');
		$this->temperatura = strip_tags($temperatura[0]);
		$this->slika = "https://www.weather2umbrella.com/wp-content/themes/w2u/image/svg/weather-icons/n01.svg"; //$this->getContents($vreme,'<a onclick="App.scrollTo(\'#weather_per_hour_wrapper\');"><img src="', '"')[0];
	}

    private function getContents($str, $startDelimiter, $endDelimiter) {
		$contents = array();
		$startDelimiterLength = strlen($startDelimiter);
		$endDelimiterLength = strlen($endDelimiter);
		$startFrom = $contentStart = $contentEnd = 0;
		while (false !== ($contentStart = strpos($str, $startDelimiter, $startFrom))) {
			$contentStart += $startDelimiterLength;
			$contentEnd = strpos($str, $endDelimiter, $contentStart);
			if (false === $contentEnd) {
			  break;
			}
			$contents[] = substr($str, $contentStart, $contentEnd - $contentStart);
			$startFrom = $contentEnd + $endDelimiterLength;
		 }

		return $contents;
	}
	
	 
	public function indexOglasi()
    {
		$this->getWeather();
		$res = Oglasi::with('slike')->orderBy('id','DESC')->paginate($this->perpage);
    	return view('oglasimain',['oglasi' => $res,'search'=>"", 'ticker' => $res, 'temperatura' => $this->temperatura, 'slika' => $this->slika ]);

    }

	public function searchOglasi(Request $request)
    {

		$search = $request->input('search');

		$res = Oglasi::where("naslov", "LIKE",'%'.$search.'%')
		->orwhere("text", "LIKE",'%'.$search.'%')
		->orderBy('id', 'DESC')->paginate($this->perpage);

		$newsticker = Vesti::orderBy('datum', 'DESC')->paginate($this->perpage);
		$this->getWeather();
		
		return view('oglasimain', ['oglasi' => $res,'search'=>$search, 'ticker' => $newsticker, 'temperatura' => $this->temperatura, 'slika' => $this->slika]);
    }
}
