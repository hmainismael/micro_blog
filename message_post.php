<?php
include('includes/connexion.inc.php');

	/*
		GESTION DES MESSAGES
		SI MODIFICATION -VERIFICATION DES VARIABLES PASSES EN POST- , MISE A JOUR EN BDD
		SI CREATION, INSERTION EN BDD
	*/
	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$query ='UPDATE messages SET contenu= :contenu , date=UNIX_TIMESTAMP() WHERE messages.id=:id';   
				$prep = $pdo->prepare($query);
				$prep->bindValue(':contenu', $_POST['message']);
				$prep->bindValue(':id', $_POST['id']);
				$prep->execute();
	}
	else if (isset($_POST['message']) && !empty($_POST['message'])) {
				$query = 'INSERT INTO messages (contenu, date, user_id) VALUES (:contenu, UNIX_TIMESTAMP(), :user_id)';       //requête préparée :contenu = variable que je déclare
				$prep = $pdo->prepare($query);
				$prep->bindValue(':contenu', $_POST['message']);       //affectation d'une valeur à la variable :contenu
				$prep->bindValue(':user_id', $id); 
				$prep->execute();
	}

	header('Location:index.php');
	exit();