<?php
/* Smarty version 3.1.30, created on 2017-02-28 16:21:11
  from "C:\wamp\www\IUT\micro_blog_smarty\templates\connexion.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b595671eb167_04281343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1456435c7627b46d3b190595d807cb39f7d87ff8' => 
    array (
      0 => 'C:\\wamp\\www\\IUT\\micro_blog_smarty\\templates\\connexion.tpl',
      1 => 1488294802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/haut.inc.tpl' => 1,
    'file:includes/bas.inc.tpl' => 1,
  ),
),false)) {
function content_58b595671eb167_04281343 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:includes/haut.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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
						<div class="col-md-8 col-md-offset-2 hidden text-center" id="msgErreur" style="color:red;font-weight:bold"></div>
						<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
							<div class="col-md-8 col-md-offset-2 text-center" style="color:red;font-weight:bold;margin-bottom:10px">Votre identifiant ou mot de passe est incorrect !</div>
						<?php }?>
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

<?php $_smarty_tpl->_subTemplateRender("file:includes/bas.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


	<?php echo '<script'; ?>
>
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
	<?php echo '</script'; ?>
>





<?php }
}
