<?php

$headers = 'From: <webmasterACE@webmasterACE.com>' . "\r\n";

mail($to, $subject, $message, $headers);

header("Location: index.php");

?>