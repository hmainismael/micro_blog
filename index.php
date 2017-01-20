<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');

/*
    REQUETE PERMETTANT D'AFFICHER LE MESSAGE SELECTIONNE POUR MODIFICATION
*/                
if(isset($_GET['id']) && !empty($_GET['id'])){
    $query = 'SELECT * FROM messages WHERE messages.id='.$_GET['id'];
    $stmt = $pdo->query($query);

    while ($data = $stmt->fetch()) 
    {
        $contenu=$data['contenu'];
    }
}
?>          

            <?php
            /*
                BOUTON QUI S'AFFICHE UNIQUEMENT APRES UNE RECHERCHE
                PERMET DE REVENIR A LA PAGE AVEC L'ENSEMBLE DES MESSAGES
            */
            if(isset($_POST['texteRecherche'])) { ?>
            <div class="row text-center" style="margin-bottom:15px">
                <a href="index.php" role="button" type="button" class="btn btn-info">Afficher tous les messages</a>
            </div>
            <?php } ?>
            <div class="row text-center" style="margin-bottom:25px">
                <form class="form-horizontal" method="POST" id="form_recherche" action="index.php">   
                    <div class="col-md-4 col-md-offset-3">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa fa-search" aria-hidden="true"></i></div>
                                <input type="text" class="form-control" name="texteRecherche" id="texteRecherche" placeholder="Saisissez votre texte...">
                                <div class="input-group-addon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                            </div>
                        </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
               </form>
            </div>

            <!--
                TEXTAREA DANS LEQUEL LE MESSAGE EST ECRIT ET/OU AFFICHE S'IL Y A MODIFICATION
            -->
            <div class="row">           
                <form method="post" action="message_post.php">
                    <div class="col-sm-10">  
                        <div class="form-group">
                            <textarea id="message" name="message" class="form-control" placeholder="Message"><?php  if(isset($contenu) && !empty($contenu)) {echo $contenu;  } ?></textarea>                  
                            <input type="hidden" name="id" value="<?php if(isset($_GET['id']) && !empty($_GET['id'])) { echo $_GET['id'];} ?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg" <?php if($connected==false) {?>disabled<?php }?> >Envoyer</button>
                    </div>                        
                </form>
            </div>


            <?php
            /*
                ENREGISTREMENT DE LA SAISIE PRESENTE DANS LA BARRE DE RECHERCHE DANS UNE VARIABLE
                POUR ADAPTER LA REQUETE LIEE A L'AFFICHAGE DES MESSAGES SUR LA PAGE
            */
            if(isset($_POST['texteRecherche']))
            {   
                $texteRecherche=$_POST['texteRecherche'];
            }
            else
            {
                $texteRecherche='';
            }

            /*
                PAGINATION : CHOIX DE 6 MESSAGES PAR PAGE, UTILISATION DE LIMIT DANS LA REQUETE SQL
            */
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

            /*
                REQUETE QUI AFFICHE LES MESSAGES SUR LA PAGE
            */
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

            while ($data = $prep->fetch()) {
            ?>

            <!--
                MESSAGES DE LA PAGE AVEC ACTIVATION DES BOUTONS MODIFIER ET SUPPRIMER UNIQUEMENT S'ILS SONT EDITES PAR L'UTILISATEUR CONCERNE
            -->
            <div class="row" style="margin-top:15px">
            	<blockquote class="col-md-12">
                    <div class="col-md-7">
            		  <?= $data['contenu_msg'] ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                      <?= date("d/m/y H:i:s", $data['date_msg']) ?>
                    </div>
                    <?php if($connected==true) {?>
                    <div class="col-md-1 col-sm-2">
                        <a href="suppr_message.php?id=<?php echo $data['id_msg'] ?>"  class="btn btn-danger" <?php if($data['user_id']!=$id) { ?>disabled<?php } ?>>Supprimer</a>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <a href="index.php?id=<?php echo $data['id_msg'] ?>"  class="btn btn-primary" <?php if($data['user_id']!=$id) { ?>disabled<?php } ?>>Modifier</a>
                    </div>
                    <?php } ?>
            	</blockquote>
            </div>
            <div class="row text-center" style="color:blue">
                <span class="badge" style="font-size:1.2em"><?= "Auteur : ".strtoupper($data['pseudo_user']) ?></span>
            </div>
	        <?php
             }
            ?>

            <!--
                PAGINATION SITUEE EN BAS DE PAGE
            -->
            <div class="row text-center" style="margin-top:15px">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-lg">
                    <?php  if($index!=1) { ?>
                    <li>
                      <a href="index.php?p=<?php echo $index-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <?php } ?>
                    <?php 
                        for($i=1;$i<=$nbPages;$i++)
                        {
                            if($i==$index)
                            {
                                echo "<li><a href=\"index.php?p=$i\" style=\"color:red\">$i</a></li>";
                            }
                            else
                            {
                                echo "<li><a href=\"index.php?p=$i\">$i</a></li>";
                            }
                        }
                    ?>
                    <?php if($index!=$nbPages) { ?>
                    <li>
                      <a href="index.php?p=<?php echo $index+1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </nav>
            </div>

<?php include('includes/bas.inc.php'); ?>