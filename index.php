<?php
include('includes/connexion.inc.php');
include('./majMessage.php');


require("tpl/smarty.class.php"); // On inclut la classe Smarty
$tpl=new Smarty();


/**********************************************************************************/
if(isset($_GET['id']) && !empty($_GET['id'])){
    $query = 'SELECT * FROM messages WHERE messages.id='.$_GET['id'];
    $stmt = $pdo->query($query);

    while ($data = $stmt->fetch()) 
    {
        $contenu=$data['contenu'];
    }
    $tpl->assign(array(
        'contenu' => $contenu,
        'getId' => $_GET['id'],
        ));
}
else
{
    $tpl->assign(array(
        'contenu' => '',
        'getId' => 0,
        ));
}

/*****************************************************************************************/
if(isset($_GET['texteRecherche']))
{   
    $texteRecherche=$_GET['texteRecherche'];
}
else
{
    $texteRecherche='';
}

$nbMsg='SELECT COUNT(*) as Nombre_Messages FROM messages  WHERE contenu LIKE \'%'.$texteRecherche.'%\' ';
$statement = $pdo->query($nbMsg);
while ($data = $statement->fetch()) {
    $nombre_messages=$data['Nombre_Messages'];
}

$MsgParPage=6;
$nbPages=($nombre_messages)?ceil($nombre_messages/$MsgParPage):1;

/*
PAGINATION : VERIFICATION DE LA VALEUR PRESENTE DANS L'URL, EN CAS DE MODIFICATION VOLONTAIRE PAR L'UTILISATEUR
*/
if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPages)
{
    $index=$_GET['p'];
}
else
{
    $index=1;
}

$tpl->assign(array(
    'nombre_messages' => $nombre_messages,
    'MsgParPage' => $MsgParPage,
    'nbPages' => $nbPages,
    'index' => $index,
    'texteRecherche' => $texteRecherche
    ));

/**********************************************************************************/
$query = 'SELECT    M.id as id_msg, 
                    U.id as user_id, 
                    M.date as date_msg, 
                    M.contenu as contenu_msg, 
                    U.pseudo as pseudo_user 
                    FROM messages M 
                    INNER JOIN utilisateur U ON U.id=M.user_id 
                    WHERE contenu LIKE \'%'.$texteRecherche.'%\'
                    ORDER BY date desc 
                    LIMIT :indexDebut , :MsgParPage';
            $prep = $pdo->prepare($query);
            $prep->bindValue(':indexDebut',  (($index-1)*$MsgParPage), PDO::PARAM_INT);
            $prep->bindValue(':MsgParPage', $MsgParPage, PDO::PARAM_INT);
            $prep->execute();

$listeMessages=array();
$i=0;
while ($data = $prep->fetch()) {
    $listeMessages[$i]['user_id']=$data['user_id'];
    $listeMessages[$i]['id_msg']=$data['id_msg'];
    $listeMessages[$i]['pseudo_user']=$data['pseudo_user'];
    $listeMessages[$i]['contenu_msg']=$data['contenu_msg'];
    $listeMessages[$i]['date_msg']=$data['date_msg'];

    $listeMessages[$i]['contenu_msg']=apercuMessage($listeMessages[$i]['contenu_msg']);

    $i++;
}


$tpl->assign(array(
    'listeMessages'=> $listeMessages,
    ));


/*****************************************************************************************/
$tpl->assign(array(
    'pseudo' => $pseudo,
    'id' => $id,
    'connected' => $connected,
    ));

$tpl->display("templates/index.tpl");




?>

