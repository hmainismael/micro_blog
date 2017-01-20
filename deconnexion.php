<?php
/*
	ON KILL LE COOKIE POUR DECONNECTER L'UTILISATEUR
*/
setcookie("cookieBlog",'',time()-1);
header('Location:index.php');