<?php
$msubject = "Agragator greska";
$from = "greska@zdravstav.net";

$message = '<html><body>';
$message .= "<p>" . $msubject."</p>";
$message .= 'Pozz Vlado, Secas li se o cemu smo pricali juce. Javi se, Nevenica!';
$message .= "</body></html>";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
if(mail("jovicicpr@gmail.com", $msubject, $message, $headers) ){
echo "do jaja";
}else{ echo 'error';
}
mail("jekic.va@gmail.com", $msubject, $message, $headers);
mail("newbalanceagency@gmail.com", $msubject, $message, $headers);
