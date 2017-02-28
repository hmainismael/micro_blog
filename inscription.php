<?php
include('includes/connexion.inc.php');

require("tpl/smarty.class.php"); // On inclut la classe Smarty
$tpl=new Smarty();
/*
	VERIFICATION DES VARIABLES POST DU FORMULAIRE D'INSCRIPTION
	SQL PERMETTANT D'ENREGISTRER LE NOUVEL UTILISATEUR EN BDD
*/
$pseudoExists=false;
if(	isset($_POST['nom']) && !empty($_POST['nom']) 
	&& isset($_POST['prenom']) && !empty($_POST['prenom'])
	&& isset($_POST['mail']) && !empty($_POST['mail']) 
	&& isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) 
	&& isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
{
	$query="SELECT pseudo FROM utilisateur WHERE pseudo LIKE '".$_POST['pseudo']."'";
	$resultat=$pdo->query($query);

	if($count=$resultat->rowCount()==0)
	{
		$query="INSERT INTO utilisateur (nom, prenom, email, mdp, pseudo) VALUES (:nom, :prenom, :mail, :motdepasse ,:pseudo)";

		$prep = $pdo->prepare($query);
		$prep->bindValue(':nom', $_POST['nom']);
		$prep->bindValue(':prenom', $_POST['prenom']);
		$prep->bindValue(':mail', $_POST['mail']);
		$prep->bindValue(':motdepasse', md5($_POST['motdepasse']));
		$prep->bindValue(':pseudo', $_POST['pseudo']);
		$prep->execute();

		/*
			REDIRECTION VERS LE FORMULAIRE DE CONNEXION SI L'INSCRIPTION ABOUTIT
		*/
		header('Location:connexion.php');
	}
	else
	{
		$pseudoExists=true;
	}
}

$tpl->assign(array(
    'pseudo' => $pseudo,
    'pseudoExists' => $pseudoExists,
    'id' => $id,
    'connected' => $connected,
    ));

$tpl->display("templates/inscription.tpl");

?>





