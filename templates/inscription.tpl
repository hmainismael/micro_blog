{include file='includes/haut.inc.tpl'}

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
						<div class="col-md-8 col-md-offset-2 hidden text-center" id="msgErreur" style="color:red;font-weight:bold"></div>
						<!--
							DIV QUI S'AFFICHERA SI LE PSEUDO SAISI EXISTE DEJA
						-->
						{if $pseudoExists}
							<div class="col-md-8 col-md-offset-2 text-center" style="color:red;font-weight:bold;margin-bottom:10px">PSEUDO EXISTANT !</div>
						{/if}
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

{include file='includes/bas.inc.tpl'}

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




