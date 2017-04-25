<?php
$pdo = new PDO('mysql:host=localhost;dbname=micro_blog', 'root', '');
/*$pdo = new PDO('mysql:host=localhost;dbname=ismael-hmainblog', 'ismael-hmainblog', 'ItjAXKy4wo4OWyF8');*/
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
    VERIFICATION DE LA PRESENCE DU COOKIE, RECUPERATION DES DONNEES LIES A CET UTILISATEUR
*/ 
if(isset($_COOKIE['cookieBlog']))
{
	$query="SELECT sessionid, pseudo, utilisateur.id FROM utilisateur WHERE sessionid=:sid";

	$prep = $pdo->prepare($query);
	$prep->bindValue(':sid', $_COOKIE['cookieBlog']);
	$prep->execute();

	if($count=$prep->rowCount()>0)
	{
		$data=$prep->fetch();

		$pseudo=$data['pseudo'];
		$id=$data['id'];

		$connected=true;
	}
}
else
{
	$connected=false;
	$pseudo='';
	$id='';
}