<?php

namespace App\Http\Controllers;
use Symfony\Component\DomCrawler\Crawler;

use Illuminate\Http\Request;
use App\Vesti;

class WelcomeController extends Controller
{
	private $perpage = 9;
	
     public function index()
    {
		
		$vesti = Vesti::orderBy('id', 'DESC')->paginate($this->perpage);
		$newsticker = Vesti::orderBy('id', 'DESC')->paginate($this->perpage);
		$vreme = file_get_contents('https://www.weather2umbrella.com/vremenska-prognoza-valjevo-serbia-sr/trenutno');
		$crawler = new Crawler($vreme);
		$temperatura = $crawler->filterXPath('//*[@id="current_weather_shadow_box"]/div/div[2]/div[2]/div[1]/div[1]/div[3]/p')->text();
		$slika = $crawler->filterXPath('//*[@id="current_weather_shadow_box"]/div/div[2]/div[2]/div[1]/div[1]/div[1]/a/img/@src')->text();
        return view('welcome',['vesti' => $vesti,'search'=>"", 'ticker' => $newsticker, 'temperatura' => $temperatura, 'slika' => $slika]);

    }
	
	public function search(Request $request)
    {
		
		$search = $request->input('search');
		
		$vesti = Vesti::where("naslov", "LIKE",'%'.$search.'%')
		->orwhere("text", "LIKE",'%'.$search.'%')
		->orwhere("datum", "LIKE",'%'.$search.'%')
		->orwhere("izvor", "LIKE",'%'.$search.'%')
		->orderBy('id', 'DESC')->paginate($this->perpage);

		//ovu su najnovije vesti ya sidebar, da pretraga ne bi uticala na njih
		$newsticker = Vesti::orderBy('id', 'DESC')->paginate($this->perpage);

		return view('welcome', ['vesti' => $vesti,'search'=>$search, 'ticker' => $newsticker]);
		

    }

    public function getContents($str, $startDelimiter, $endDelimiter) {
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
}
