<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

/*
    VERIFICATION DES ACCES DE L'UTILISATEUR
    SI PSEUDO ET MOT DE PASSE CORRECT : REDIRECTION VERS L'INDEX SINON CHARGEMENT A NOUVEAU DE LA PAGE CONNEXION
*/ 
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
		header('Location:./connexion.php');
	}

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
					<form class="form-horizontal" method="POST" id="form_connexion" action="connexion.php">
						<div class="form-group" style="margin-top:20px">
							<label class="col-md-4 control-label text-right" for="email" >Identifiant :</label>
							<div class="col-md-8" id="pseudoDIV">
								<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label text-right" for="motdepasse">Mot de passe :</label>
							<div class="col-md-8" id="motdepasseDIV">
								<input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
							</div>
						</div>
						<div class="col-md-8 col-md-offset-2 hidden text-center" id="msgErreur" style="color:red;font-weight:bold">
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

	<script>
		/*
	    	PARTIE JQUERY UTILISE POUR VERIFIER REMPLISSAGE DES CHAMPS
		*/ 
		$(function(){
			$("#form_connexion").submit(function(){

				$("#pseudoDIV").removeClass("has-error");
				$("#motdepasseDIV").removeClass("has-error");

				if( $("#pseudo").val() == '')
				{
					$("#msgErreur").html("Veuillez saisir un pseudo !");
					$("#msgErreur").addClass("alert alert-danger");
					$("#pseudoDIV").addClass("has-error");
					$("#msgErreur").removeClass("hidden");
					return false;

				}
				else if( $("#motdepasse").val() == '')
				{
					$("#msgErreur").html("Veuillez saisir un mot de passe !");
					$("#msgErreur").addClass("alert alert-danger");
					$("#motdepasseDIV").addClass("has-error");
					$("#msgErreur").removeClass("hidden");
					return false;

				}
				else{
					return true;
				}

			});
		});
	</script>

	<?php
}

include('includes/bas.inc.php'); ?>




