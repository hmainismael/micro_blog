{include file='includes/haut.inc.tpl'}

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
						<div class="col-md-8 col-md-offset-2 hidden text-center" id="msgErreur" style="color:red;font-weight:bold"></div>
						{if $error}
							<div class="col-md-8 col-md-offset-2 text-center" style="color:red;font-weight:bold;margin-bottom:10px">Votre identifiant ou mot de passe est incorrect !</div>
						{/if}
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

{include file='includes/bas.inc.tpl'}

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





