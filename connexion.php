<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['motdepasse']) && !empty($_POST['motdepasse']))
{


	/*$query="SELECT pseudo, mdp FROM utilisateur";

	$stmt = $pdo->query($query);

	while($data = $stmt->fetch())
	{
		$email = $data['pseudo'];
		$mdp = $data['mdp'];

		if($email == $_POST['pseudo'] && $mdp == md5($_POST['motdepasse']))
		{
			$sid=md5($_POST('pseudo').$_POST['motdepasse'].time());

			setcookie(name)


			header('Location:index.php');
		}
	}*/

	$query="SELECT * FROM utilisateur WHERE pseudo=:pseudo AND mdp=:motdepasse";

	$prep = $pdo->prepare($query);
	$prep->bindValue(':pseudo', $_POST['pseudo']);
	$prep->bindValue(':motdepasse', md5($_POST['motdepasse']));
	$prep->execute();

	if($count=$prep->rowCount()>0)
	{
		$data=$prep->fetch();

		$id=$data['id'];

		$sid=md5($_POST['pseudo'].$_POST['motdepasse'].time());

		setcookie("cookieBlog", $sid, time()+3600);

		$query = 'UPDATE utilisateur SET sessionid=:sid WHERE id=:id ';       //requête préparée :contenu = variable que je déclare
				$prep = $pdo->prepare($query);
				$prep->bindValue(':sid', $sid);     
				$prep->bindValue(':id', $id);  
				$prep->execute();

		header('Location:index.php');
	}
	else
	{
		header('Location:./connexion.php');
	}


/*TRAITEMENT
	requete sql préparée pour verif utilisateur (email, mdp)
		where email=email and mdp=md5($_POST('mdp')

	UTILISATION DE LA FONCTION MD5 QUAND INSERTION D'UN MOT DE PASSE DANS PHP MYADMIN !!!

Génération SID
	utilisation de md5 pour générer une grande chaine aléatoire
		$sid=md5($_POST('email').time());
Stockage SID cookie
Stockage SID BDD
	ajout champ SessionID varchar dans la table utilisateur

	REDIRIGER VERS INDEX OU CONNEXION SI FAUX*/



}
else{
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel panel-heading text-center">
					<h3 class="panel-title">
						AUTHENTIFICATION
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<img src="img/cadenas.jpg" alt="cadenas" class="img-rounded" >
						</div>
					</div>
					<form class="form-horizontal" method="POST" action="connexion.php">
						<div class="form-group" style="margin-top:20px">
							<label class="col-md-4 control-label text-right" for="email" >Identifiant :</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="motdepasse">Mot de passe :</label>
							<div class="col-md-8">
								<input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<button type="submit" class="btn btn-primary btn-block">Se connecter</button>
							</div>
						</div>
					</form>
				</div>

				<div class="panel-footer">
					Mot de passe perdu ? <a href="#"> Cliquez ici</a>
				</div>
			</div>
		</div>
	</div>


	<?php
	/*REDIRIGE VERS CONNEXION.PHP*/
}

include('includes/bas.inc.php'); ?>