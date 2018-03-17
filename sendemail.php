<?php
$name       = @trim(stripslashes($_POST['name'])); 
$from       = @trim(stripslashes($_POST['email'])); 
$telefon    = @trim(stripslashes($_POST['telefon'])); 
$message    = @trim(stripslashes($_POST['mesaj'])); 

$email_from = $email;
$to   		= 'ghergheluca_edi@yahoo.com';//replace with your email


$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: $name";

$headers[] = "Telefon: $telefon";
$headers[] = "X-Mailer: PHP/".phpversion();


mail($to, $telefon, "Mesaj de la $from: \n".  $message, implode("\r\n", $headers));

var_dump($_POST);
var_dump("From: $name <$from>");

die;
?>
