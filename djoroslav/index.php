<?php

include "connection.php";

function getContents($str, $startDelimiter, $endDelimiter) {
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

function deleteContents($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
	  if ($beginningPos === false || $endPos === false) {
		return $string;
	  }

	$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
	$string = str_replace($textToDelete, '', $string);

  return $string;
}

function reportError(array $newerrors, $key, $data){

	$newerrors[$key] = $data;
	return $newerrors;
}

function CirToLat($text){
$cir = ['Љ','Њ','Е','Р','Т','З','У','И','О','П','Ш','Ђ',
		'А','С','Д','Ф','Г','Х','Ј','К','Л','Ч','Ћ','Ж',
		'Џ','Ц','В','Б','Н','М',
		'љ','њ','е','р','т','з','у','и','о','п','ш','ђ',
		'а','с','д','ф','г','х','ј','к','л','ч','ћ','ж',
		'џ','ц','в','б','н','м'];

$lat = ['Lj','Nj','E','R','T','Z','U','I','O','P','Š','Đ',
		'A','S','D','F','G','H','J','K','L','Č','Ć','Ž',
		'Dž','C','V','B','N','M',
		'lj','nj','e','r','t','z','u','i','o','p','š','đ',
		'a','s','d','f','g','h','j','k','l','č','ć','ž',
		'dž','c','v','b','n','m'];

return str_replace($cir,$lat,$text);
}

$linkovi = array('https://www.blic.rs/valjevo',
				'http://vamedia.info',
				'http://www.kolubarske.rs/sr/vesti/valjevo/',
				'http://www.kolubarske.rs/sr/vesti/okrug/',
				'http://www.kolubarske.rs/sr/vesti/privreda/',
				'http://www.kolubarske.rs/sr/vesti/sport/',
				'http://www.kolubarske.rs/sr/vesti/kultura/',
				'http://www.kolubarske.rs/sr/vesti/zivot/'
				);

$errors = array();
$artikli_sve = array();

foreach($linkovi as $link){

	$strana = @file_get_contents($link);

	/* Blic */
	if (strpos($link, 'blic') !== false) {
		$articles = getContents($strana, '<article class="main-list__item"', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){

			$ceo_text_link = $ceo_text_link[0];
			$ceo_text = @file_get_contents($ceo_text_link);
			$datum = getContents($ceo_text, '<time datetime="', '"');
			if(!empty($datum)){

			$time = strtotime($datum[0]);
			$ceo_text = getContents($ceo_text, '</figure>', '<div');
			if(!empty($ceo_text)){

			$text = trim(preg_replace('/\s\s+/', '', strip_tags($ceo_text[0])));
			$naslov = str_replace(["<a href=\"",$ceo_text_link,"\">","</a>"],"",getContents($article, '<h3>', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);
			if(empty($errors['blic'])){
				array_push($artikli_sve,array(

					"link" => $ceo_text_link,
					"image" => getContents($article, '<img src="', '"')[0],
					"naslov" => $naslov,
					"text" => $text,
					"datum" => $time,
					"izvor" => "Blic"

				));
			}
			}else{
				$errors = reportError($errors,"blic", "text - greska u citanju; linija 76");
			}
			}else{
				$errors = reportError($errors,"blic", "datum - greska u citanju; linija 71");
			}
			}else{
				$errors = reportError($errors,"blic", "article - greska u citanju; linija 66");
			}
		}
		}else{
			$errors = reportError($errors,"blic","articles - greska u citanju; linija 61");
		}
	}

	/* Vamedia */
	if (strpos($link, 'vamedia') !== false) {

	function vamediadatum($datum){

		$meseci = array(
			"januar" => "01",
			"februar" => "02",
			"mart" => "03",
			"april" => "04",
			"maj" => "05",
			"jun" => "06",
			"jul" => "07",
			"avgust" => "08",
			"septembar" => "09",
			"oktobar" => "10",
			"novembar" => "11",
			"decembar" => "12"
		);

		$datum1 = explode(",",$datum);
		$datum1 = explode(" ",trim($datum1[1]));
		$dan =$datum1[0];
		$mesec = $meseci[$datum1[1]];
		$god =$datum1[2];
		$sat =$datum1[3];
		return $dan.".".$mesec.".".$god.".".$sat;
	}

	/* Slajder */
		$articles = getContents($strana, '<div class="description feature-pad">', '</div>');
		if(!empty($articles)){
		$imagesslajder = getContents($strana, "push('", "'");
		$imagekey = 1;

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){

			$ceo_text_link = $link.$ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);
			$ceo_text = getContents($ceo_text, '<div class="item-page">', '<div class="roksocialbuttons addthis_toolbox  "');
			if(!empty($ceo_text)){
			$ceo_text = $ceo_text[0];

			$datum = getContents($ceo_text, '<div class="rt-date-posted">', '</div>');
			if(!empty($datum)){

			$datum = vamediadatum($datum[0]);
			$time = strtotime($datum);

			$text1 = getContents($ceo_text, '<p>', '</p>');
			if(!empty($text1)){
			$text = "";
			foreach($text1 as $tx){
				$text .= $tx;
			}
			$text = strip_tags($text);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = getContents($article, '<span class="feature-title">', '</span>')[0];
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => $link.$imagesslajder[$imagekey],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Vamedia"
			));
			$imagekey++;
			}else{
				$errors = reportError($errors,"Vamedia_Slajder", "text - greska u citanju; linija 164");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Slajder", "datum - greska u citanju; linija 157");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Slajder", "ceo_text - greska u citanju; linija 153");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Slajder", "ceo_text_link - greska u citanju; linija 147");
			}

		}
		}else{
			$errors = reportError($errors,"Vamedia_Slajder","articles - greska u citanju; linija 139");
		}

		/* Vesti */
		$articles = getContents($strana, '<div class="micronews-article">', '</div>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $link.$ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);
			$ceo_text = getContents($ceo_text, '<div class="item-page">', '<div class="roksocialbuttons addthis_toolbox  "');
			if(!empty($ceo_text)){
			$ceo_text = $ceo_text[0];

			$datum = getContents($ceo_text, '<div class="rt-date-posted">', '</div>');
			if(!empty($datum)){
			$datum = vamediadatum($datum[0]);
			$time = strtotime($datum);

			$text1 = getContents($ceo_text, '<p>', '</p>');
			if(!empty($text1)){
			$text = "";
			foreach($text1 as $tx){
				$text .= $tx;

			}
			$text = strip_tags($text);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = getContents($article, '<p>', '</p>')[0];
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);
			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => $link.getContents($article, 'src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Vamedia"

			));
			}else{
				$errors = reportError($errors,"Vamedia_Vesti", "text - greska u citanju; linija 223");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Vesti", "datum - greska u citanju; linija 218");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Vesti", "ceo_text - greska u citanju; linija 213");
			}
			}else{
				$errors = reportError($errors,"Vamedia_Vesti", "ceo_text_link - greska u citanju; linija 209");
			}
		}
		}else{
			$errors = reportError($errors,"Vamedia_Vesti","articles - greska u citanju; linija 204");
		}

	}


	/* Kolubarske valjevo */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/valjevo/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Valjevo", "ceo_text - greska u citanju; linija 287");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Valjevo", "ceo_text - greska u citanju; linija 284");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Valjevo", "datum - greska u citanju; linija 279");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Valjevo", "ceo_text_link - greska u citanju; linija 273");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Valjevo","articles - greska u citanju; linija 268");
		}
	}

	/* Kolubarske okrug */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/okrug/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Okrug", "ceo_text - greska u citanju; linija 342");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Okrug", "ceo_text - greska u citanju; linija 341");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Okrug", "datum - greska u citanju; linija 336");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Okrug", "ceo_text_link - greska u citanju; linija 330");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Okrug","articles - greska u citanju; linija 325");
		}
	}


	/* Kolubarske privreda */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/privreda/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Privreda", "ceo_text - greska u citanju; linija 401");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Privreda", "ceo_text - greska u citanju; linija 399");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Privreda", "datum - greska u citanju; linija 394");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Privreda", "ceo_text_link - greska u citanju; linija 388");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Privreda","articles - greska u citanju; linija 383");
		}
	}


	/* Kolubarske sport */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/sport/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Sport", "ceo_text - greska u citanju; linija 459");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Sport", "ceo_text - greska u citanju; linija 457");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Sport", "datum - greska u citanju; linija 452");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Sport", "ceo_text_link - greska u citanju; linija 446");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Sport","articles - greska u citanju; linija 441");
		}
	}

	/* Kolubarske kultura */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/kultura/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Kultura", "ceo_text - greska u citanju; linija 516");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Kultura", "ceo_text - greska u citanju; linija 514");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Kultura", "datum - greska u citanju; linija 509");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Kultura", "ceo_text_link - greska u citanju; linija 503");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Kultura","articles - greska u citanju; linija 498");
		}
	}

	/* Kolubarske zivot */
	if (strpos($link, 'http://www.kolubarske.rs/sr/vesti/zivot/') !== false) {
		$articles = getContents($strana, '<article class="news_item">', '</article>');
		if(!empty($articles)){

		foreach($articles as $article){

			$ceo_text_link = getContents($article, '<a href="', '"');
			if(!empty($ceo_text_link)){
			$ceo_text_link = $ceo_text_link[0];

			$ceo_text = @file_get_contents($ceo_text_link);

			$datum = getContents($ceo_text, '<h6 class="info">', '</h6>');
			if(!empty($datum)){
			$datum = str_replace(",","",$datum[0]);
			$time = strtotime($datum);

			$ceo_text = getContents($ceo_text, '<article class="news_item span8">', '</article>');
			if(!empty($ceo_text)){
			$ceo_text = getContents($ceo_text[0], '</script>', '<script>');
			if(!empty($ceo_text)){
			$text = strip_tags($ceo_text[0]);

			$text = trim(preg_replace('/\s\s+/', '', $text));
			$naslov = str_replace(['<a href="'.$ceo_text_link.'" target="_self">','</a>'],"",getContents($article, '<h3 class="title">', '</h3>')[0]);
			$naslov = trim(preg_replace('/\s\s+/', '', $naslov));
			$naslov = strip_tags($naslov);

			array_push($artikli_sve,array(

				"link" => $ceo_text_link,
				"image" => "http://www.kolubarske.rs".getContents($article, '<img src="', '"')[0],
				"naslov" => $naslov,
				"text" => $text,
				"datum" => $time,
				"izvor" => "Kolubarske"

			));
			}else{
				$errors = reportError($errors,"Kolubarske_Zivot", "ceo_text - greska u citanju; linija 573");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Zivot", "ceo_text - greska u citanju; linija 571");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Zivot", "datum - greska u citanju; linija 566");
			}
			}else{
				$errors = reportError($errors,"Kolubarske_Zivot", "ceo_text_link - greska u citanju; linija 560");
			}
		}
		}else{
			$errors = reportError($errors,"Kolubarske_Zivot","articles - greska u citanju; linija 555");
		}
	}

}

/* WP */

/* Mars */

$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('http://marsh.co.rs/wp-json/wp/v2/posts?_embed&category=91')));
if(!empty($res)){
foreach ($res as $r) {


	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

		array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
			"naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "Mars"

        ));
	}

}
}else{
	$errors = reportError($errors,"Mars","Json String - greska u citanju; linija 616");
}

/* Valjevska posla */

$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('https://www.valjevskaposla.info/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

		array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "Valjevska posla"

        ));
	}
}
}else{
	$errors = reportError($errors,"Valjevska_posla","Json String - greska u citanju; linija 642");
}
/* va1.info */

$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('https://www.va1.info/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

    array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => CirToLat(strip_tags($r->title->rendered)),
            "text" => CirToLat(strip_tags($r->content->rendered)),
            "datum" => strtotime($r->date),
            "izvor" => "Va1.info"

        ));
	}
}
}else{
	$errors = reportError($errors,"va1_info","Json String - greska u citanju; linija 665");
}
/* kolubarski.info */
$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('http://kolubarski.info/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

    array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "kolubarski.info"

        ));
	}
}
}else{
	$errors = reportError($errors,"Kolubarski","Json String - greska u citanju; linija 687");
}

/* Valjevske novosti */
$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('http://www.valjevskenovosti.com/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

    array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "Valjevske novosti"

        ));
	}
}
}else{
	$errors = reportError($errors,"Valjevske_novosti","Json String - greska u citanju; linija 711");
}

/* Patak */
$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('https://www.patak.co.rs/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {

    array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "Patak"

        ));
	}
}
}else{
	$errors = reportError($errors,"Patak","Json String - greska u citanju; linija 733");
}

/* Va014.info */
$res = json_decode(str_replace("wp:featuredmedia","wpfeaturedmedia",@file_get_contents('https://va014.info/wp-json/wp/v2/posts?_embed')));
if(!empty($res)){
foreach ($res as $r) {

	if(isset($r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url)) {


    array_push($artikli_sve,array(

            "link" => $r->link,
            "image" => $r->_embedded->wpfeaturedmedia[0]->media_details->sizes->thumbnail->source_url,
            "naslov" => strip_tags($r->title->rendered),
            "text" => strip_tags($r->content->rendered),
            "datum" => strtotime($r->date),
            "izvor" => "Va014.info"

        ));
	}
}
}else{
	$errors = reportError($errors,"Va014","Json String - greska u citanju; linija 756");
}

shuffle($artikli_sve);
usort($artikli_sve, function($a, $b) {
    return $a['datum'] > $b['datum'];
});

$conekcija = new connection();
$conn = $conekcija->getConnection();
function input($data){

	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}
foreach($artikli_sve as $artikal){

		$naslov = input($artikal['naslov']);
		$link = input($artikal['link']);
		$image = $artikal['image'];
		$text = input($artikal['text']);
		$datum = date("d.m.Y H:i",input($artikal['datum'])) ;
		$izvor = input($artikal['izvor']);

	    $sql="SELECT * from vestis WHERE naslov LIKE '%$naslov%'";
        $result = mysqli_query($conn,$sql);
        $count_row = $result->num_rows;

        if ($count_row == 0) {

			$upis = "INSERT INTO vestis (link, slika,naslov,text,datum,izvor,privilegija) VALUES
			('$link', '$image','$naslov','$text','$datum','$izvor','0')";

            if ($conn->query($upis)  !== TRUE) {

               // echo $upis."<br>".$conn->error;
				$errors = reportError($errors,"MySql",$conn->error);
            }
		}

}

if(!empty ($errors)){

	$greska = '';
	foreach($errors as $key => $value) {
		$greska .=  '<p>' . $key . ' : ' . $value . '</p>';
	}
	
	$msubject = "Agragator greska";
	$from = "greska@zdravstav.net";

	$message = '<html><body>';
	$message .= "<p>" . $msubject."</p>";
	$message .= $greska;
	$message .= "</body></html>";
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
if (mail("jovicicpr@gmail.com", $msubject, $message, $headers) ) {
	echo "do jaja";
}
    mail("jekic.va@gmail.com", $msubject, $message, $headers);
	mail("newbalanceagency@gmail.com", $msubject, $message, $headers);

}
