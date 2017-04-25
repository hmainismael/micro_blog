<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Micro blog</title>

    <!--<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/freelancer.css" rel="stylesheet">
    <!--<link href="min/?f=micro_blog_smarty/css/freelancer.css" rel="stylesheet">-->
    <!--<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="css/codeCSS.css" rel="stylesheet">
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
                        {if !$connected}
                        <a href="inscription.php">Inscription</a>
                        {/if}
                    </li>
                    <li class="page-scroll">
                        {if !$connected}
                        <a href="connexion.php">Connexion</a>
                        {else}
                        <a href="deconnexion.php">Déconnexion</a>
                        {/if}
                    </li>
                </ul>
                <!--
                    AFFICHAGE DU PSEUDO DE L'UTILISATEUR CONNECTE
                -->
                {if $connected}
                <div class="row text-center" id="pseudoUser">
                    Hello {$pseudo} !
                </div>
                {/if}
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
        <div class="container">