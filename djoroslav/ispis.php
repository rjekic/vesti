<?php

include "connection.php";

$conekcija = new connection();
$conn = $conekcija->getConnection();

$sql="SELECT * from vestis order by id desc";
$result = mysqli_query($conn,$sql);

while ($rows = mysqli_fetch_array($result)){
 
	echo '
	<div>
		<img src="'.$rows['slika'].'" style="width:60px;height:50px;" alt="'.$rows['naslov'].'">
		<h3><a href="'.$rows['link'].'">'.$rows['naslov'].'</a> </h3>
		<p>'.$rows['text'].'</p>
		<p>'. date("d.m.Y H:i",intval ($rows['datum'])).'</p>
		<p>'.$rows['izvor'].'</p>
	</div>
	';
}