<?php
include('includes/connexion.inc.php');

	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$query ='UPDATE messages SET contenu= :contenu , date=UNIX_TIMESTAMP() WHERE id=:id';   
				$prep = $pdo->prepare($query);
				$prep->bindValue(':contenu', $_POST['message']);
				$prep->bindValue(':id', $_POST['id']);
				$prep->execute();
	}
	else if (isset($_POST['message']) && !empty($_POST['message'])) {
				$query = 'INSERT INTO messages (contenu, date) VALUES (:contenu, UNIX_TIMESTAMP())';       //requête préparée :contenu = variable que je déclare
				$prep = $pdo->prepare($query);
				$prep->bindValue(':contenu', $_POST['message']);       //affectation d'une valeur à la variable :contenu
				$prep->execute();
	}

	header('Location:index.php');
	exit();