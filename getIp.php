<?php
/*RECUPERATION DE L'ADRESSE IP DE L'UTILISATEUR CONNECTE*/
if (!empty($_SERVER['REMOTE_ADDR']))
{
  $ip=$_SERVER['REMOTE_ADDR'];
}
echo json_encode(array('ip' => $ip));