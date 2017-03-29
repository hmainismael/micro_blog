<?php
include('./majMessage.php');
$string=$_GET['message'];
$message=apercuMessage($string);
echo $message;


