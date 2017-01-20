<?php
include('includes/connexion.inc.php');

	/*
		GESTION DES MESSAGES
		SUPPRESSION DU MESSAGE SELECTIONNE
	*/
	$query ='DELETE FROM messages WHERE id=:id';   
	$prep = $pdo->prepare($query);
	$prep->bindValue(':id', $_GET['id']);
	$prep->execute();

	header('Location:index.php');
	exit();