<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

/*
	VERIFICATION DES VARIABLES POST DU FORMULAIRE D'INSCRIPTION
	SQL PERMETTANT D'ENREGISTRER LE NOUVEL UTILISATEUR EN BDD
*/
if(	isset($_POST['nom']) && !empty($_POST['nom']) 
	&& isset($_POST['prenom']) && !empty($_POST['prenom']) 
	&& isset($_POST['mail']) && !empty($_POST['mail']) 
	&& isset($_POST['motdepasse']) && !empty($_POST['motdepasse']) 
	&& isset($_POST['pseudo']) && !empty($_POST['pseudo']) )
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
	header('Location:./connexion.php');
}
else{
	?>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel panel-heading text-center">
					<h3 class="panel-title">
						INSCRIPTION
					</h3>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 text-center">
							<i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i>
						</div>
					</div>
					<form class="form-horizontal" method="POST" id="form_inscription" action="inscription.php">
						<div class="form-group" style="margin-top:20px">
							<label class="col-md-4 control-label text-right" for="nom" >Nom :</label>
							<div class="col-md-7">
								<input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="prenom">Prénom :</label>
							<div class="col-md-7">
								<input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="mail">Adresse mail :</label>
							<div class="col-md-7">
								<input type="text" class="form-control" id="mail" name="mail" placeholder="Mail">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="pseudo">Pseudo :</label>
							<div class="col-md-7">
								<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="motdepasse">Mot de passe :</label>
							<div class="col-md-7">
								<input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
							</div>
						</div>
						<!--
							DIV QUI S'AFFICHERA SI DES CHAMPS NE SONT PAS REMPLIS, AFFICHAGE GRACE A JQUERY
						-->
						<div class="col-md-8 col-md-offset-2 hidden text-center" id="msgErreur" style="color:red;font-weight:bold">
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
		/*
			VERIFICATION QUE TOUS LES CHAMPS DU FORMULAIRE D'INSCRIPTION SONT SAISIS
		*/
		$(function(){
			$("#form_inscription").submit(function(){

				if( $("#nom").val() == '' || $("#prenom").val() == '' || $("#mail").val() == '' || $("#pseudo").val() == '' || $("#motdepasse").val() == '' )
				{
					$("#msgErreur").html("Tous les champs sont obligatoires !");
					$("#msgErreur").addClass("alert alert-danger");
					$("#msgErreur").removeClass("hidden");
					return false;
				}
				else
				{
					return true;
				}

			});
		});
	</script>

	

	<?php
}

include('includes/bas.inc.php'); ?>




