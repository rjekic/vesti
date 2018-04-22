<?php

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

$linkovi = array('https://www.blic.rs/valjevo','http://vamedia.info');

$artikli_sve = array();

foreach($linkovi as $link){
	  
	$strana = file_get_contents($link);
	
	/* Blic */
	if (strpos($link, 'blic') !== false) {
		$articles = getContents($strana, '<article class="main-list__item"', '</article>');
		foreach($articles as $article){
			
			array_push($artikli_sve,array(
				
				"link" => getContents($article, '<a href="', '"')[0],
				"image" => getContents($article, '<img src="', '"')[0],
				"naslov" => str_replace(["<a href=\"",getContents($article, '<a href="', '"')[0],"\">","</a>"],"",getContents($article, '<h3>', '</h3>')[0]),
				"text" => getContents($article, '<p>', '</p>')[0],
				"datum" =>str_replace(["\n"," "],"",getContents($article, ' <li class="list-timestamp">', '</li>')[0])
			
			));
		}
	}
	
	/* Vamedia */
	if (strpos($link, 'vamedia') !== false) {
		
	/* Slajder */
		$articles = getContents($strana, '<div class="description feature-pad">', '</div>');
		$imagesslajder = getContents($strana, "push('", "'");
		$imagekey = 1;
		foreach($articles as $article){
			
			array_push($artikli_sve,array(
				
				"link" => $link.getContents($article, '<a href="', '"')[0],
				"image" => $link.$imagesslajder[$imagekey],
				"naslov" => getContents($article, '<span class="feature-title">', '</span>')[0],
				"text" => getContents($article, '<span class="feature-desc">', '</span>')[0],
				"datum" => "07.04.2018.21:28" //getContents($article, '<span class="created-date">', '</span>')[0]
			
			));
			$imagekey++;	
		}
		
		/* Vesti */
		$articles = getContents($strana, '<div class="micronews-article">', '</div>');
		
		foreach($articles as $article){
			
			array_push($artikli_sve,array(
				
				"link" => $link.getContents($article, '<a href="', '"')[0],
				"image" => $link.getContents($article, 'src="', '"')[0],
				"naslov" => getContents($article, '<p>', '</p>')[0],
				"text" => getContents($article, '<p>', '</p>')[0],
				"datum" => "07.04.2018.21:28" //getContents($article, '<p>', '</p>')[0]
			
			));
		}
		
	}
	
}

shuffle($artikli_sve);
usort($artikli_sve, function($a, $b) {
    return $a['datum'] < $b['datum'];
});

file_put_contents("nasiartikli.json",json_encode($artikli_sve));

/* Cita iz fajla  */

$artikli_iz_fajle = json_decode(file_get_contents("nasiartikli.json"));

foreach($artikli_iz_fajle as $artikal){
	
echo '
<div>
	<img src="'.$artikal->image.'" style="width:60px;height:50px;" alt="'.$artikal->naslov.'">
	<h3><a href="'.$artikal->link.'">'.$artikal->naslov.'</a> </h3>
	<p>'.$artikal->text.'</p>
	<p>'.$artikal->datum.'</p>
</div>
';
	
	
}




