<?php
/* Smarty version 3.1.30, created on 2017-02-28 16:15:25
  from "C:\wamp\www\IUT\micro_blog_smarty\includes\haut.inc.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b5940d073e81_72668336',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '96d86779d4aaba5f70063413d0720c55e9847f19' => 
    array (
      0 => 'C:\\wamp\\www\\IUT\\micro_blog_smarty\\includes\\haut.inc.tpl',
      1 => 1488294805,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58b5940d073e81_72668336 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Micro blog</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/freelancer.css" rel="stylesheet">

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <?php echo '<script'; ?>
 src="js/jquery-3.1.0.min.js"><?php echo '</script'; ?>
>

</head>

<body id="page-top" class="index">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">Micro blog</a>
            </div>

            <!--
                AFFICHAGE DES BOUTONS DE NAVIGATION SELON VALEUR DE LA VARIABLE $CONNECTED
                SI UTILISATEUR CONNECTE, BOUTON INSCRIPTION DISPARAIT ET BOUTON CONNEXION REMPLACE PAR BOUTON DECONNEXION
            -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <?php if (!$_smarty_tpl->tpl_vars['connected']->value) {?>
                        <a href="inscription.php">Inscription</a>
                        <?php }?>
                    </li>
                    <li class="page-scroll">
                        <?php if (!$_smarty_tpl->tpl_vars['connected']->value) {?>
                        <a href="connexion.php">Connexion</a>
                        <?php } else { ?>
                        <a href="deconnexion.php">Déconnexion</a>
                        <?php }?>
                    </li>
                </ul>
                <!--
                    AFFICHAGE DU PSEUDO DE L'UTILISATEUR CONNECTE
                -->
            <?php if ($_smarty_tpl->tpl_vars['connected']->value) {?>
            <div class="row text-center" style="color:white;font-size:2em">
                Hello <?php echo $_smarty_tpl->tpl_vars['pseudo']->value;?>
 !
            </div>
            <?php }?>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-text">
                        <span class="name">Le fil</span>
                        <hr class="star-light">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container"><?php }
}
