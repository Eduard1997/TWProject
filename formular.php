<?php

$var1 = $_POST['nume'];
$var2 = $_POST['user'];
$var3 = $_POST['password'];

$file=fopen("mytext.txt","a+");

if(isset($_POST['profesor'])) {
    fwrite($file, "Profesie: ");    
   fwrite($file,"profesor");
   fwrite($file, "\r\n");
}


if(isset($_POST['student'])){
    fwrite($file, "Profesie: ");    
   fwrite($file,"student");
   fwrite($file, "\r\n");
}

if($var1 <> "" and $var2 <> "" and $var3 <> "") {
    fwrite($file, "Nume: ");    
   fwrite($file,$var1);
   fwrite($file, "\r\n");
   fwrite($file, "User: ");
   fwrite($file,$var2);
   fwrite($file, "\r\n");
   fwrite($file, "Parola: ");
   fwrite($file,$var3);
   fwrite($file, "\r\n");
   fwrite($file, "\r\n");
   echo "Multumim pentru inregistrare " . $var1;
   
}
fclose($file);

?>
        