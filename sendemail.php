<?php
$name = $_POST['name'];
$subject = $_POST['subject'];
$email = $_POST['email'];
$message = $_POST['mesaj'];
$to = "ghergheluca_edi@yahoo.com";
$message = wordwrap($msg,70);
mail($to, $subject, $message);


?>
