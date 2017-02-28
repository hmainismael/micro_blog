<?php
include('includes/connexion.inc.php');

require("tpl/smarty.class.php"); // On inclut la classe Smarty
$tpl=new Smarty();

/*
    VERIFICATION DES ACCES DE L'UTILISATEUR
    SI PSEUDO ET MOT DE PASSE CORRECT : REDIRECTION VERS L'INDEX SINON CHARGEMENT A NOUVEAU DE LA PAGE CONNEXION
*/ 
$error=false;
if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['motdepasse']) && !empty($_POST['motdepasse']))
{
	$query="SELECT * FROM utilisateur WHERE pseudo=:pseudo AND mdp=:motdepasse";

	$prep = $pdo->prepare($query);
	$prep->bindValue(':pseudo', $_POST['pseudo']);
	$prep->bindValue(':motdepasse', md5($_POST['motdepasse']));
	$prep->execute();

	if($count=$prep->rowCount()>0)
	{
		$data=$prep->fetch();

		$id=$data['id'];

		/*
		    CREATION D'UN COOKIE CONTENANT POUR VALEUR UN SID COMPOSE DES ACCES DE LA PERSONNE CONCATENES AVEC LA FONCTION TIME() DE PHP
		    ENREGISTREMENT EN BDD DU SID
		*/ 
		$sid=md5($_POST['pseudo'].$_POST['motdepasse'].time());

		setcookie("cookieBlog", $sid, time()+3600);

		$query = 'UPDATE utilisateur SET sessionid=:sid WHERE utilisateur.id=:id ';
				$prep = $pdo->prepare($query);
				$prep->bindValue(':sid', $sid);     
				$prep->bindValue(':id', $id);  
				$prep->execute();

		header('Location:index.php');
	}
	else
	{
		/*
		    RENVOI D'UNE VARIABLE QUI PERMETTRA D'AFFICHER UN MSG SI LES SAISIES NE SONT PAS CORRECTES
		*/ 
		$error=true;
	}
}

$tpl->assign(array(
    'pseudo' => $pseudo,
    'error' => $error,
    'id' => $id,
    'connected' => $connected,
    ));

$tpl->display("templates/connexion.tpl");

?>




