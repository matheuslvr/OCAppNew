<?php

/*
$to = $_GET["to"];
$subject = $_GET["subject"];
$message = $_GET["message"]; */
$headers = 'From: <webmasterACE@webmasterACE.com>' . "\r\n";

mail($to, $subject, $message, $headers);

echo $to . "<br>";
echo $subject . "<br>";
echo $message . "<br>";



?>