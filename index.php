<?php
include('includes/connexion.inc.php');
include('includes/haut.inc.php');
?>

            <div class="row">              
                <form method="post" action="message_post.php">
                    <div class="col-sm-10">  
                        <div class="form-group">
                            <?php
                                if(isset($_GET['id']) && !empty($_GET['id'])){
                                    $query = 'SELECT * FROM messages WHERE messages.id='.$_GET['id'];
                                    $stmt = $pdo->query($query);

                                    while ($data = $stmt->fetch()) 
                                    {
                                            $contenu=$data['contenu'];
                                            }
                                    }
                                ?>
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

            

            $nbMsg='SELECT COUNT(*) as Nombre_Messages FROM messages';
            $statement = $pdo->query($nbMsg);
            while ($data = $statement->fetch()) {
                $nombre_messages=$data['Nombre_Messages'];
            }

            $MsgParPage=6;
            $nbPages=($nombre_messages)?ceil($nombre_messages/$MsgParPage):1;

            //$page = $_GET['p'];
            if(isset($_GET['p']) && $_GET['p']>0 && $_GET['p']<=$nbPages)
            {
                $index=$_GET['p'];
            }
            else
            {
                $index=1;
            }

            $query = 'SELECT    M.id as id_msg, 
                                U.id as user_id, 
                                M.date as date_msg, 
                                M.contenu as contenu_msg, 
                                U.pseudo as pseudo_user 
                                FROM messages M 
                                INNER JOIN utilisateur U ON U.id=M.user_id 
                                ORDER BY date desc 
                                LIMIT :indexDebut , :MsgParPage';
            $prep = $pdo->prepare($query);
            $prep->bindValue(':indexDebut',  (($index-1)*$MsgParPage), PDO::PARAM_INT);
            $prep->bindValue(':MsgParPage', $MsgParPage, PDO::PARAM_INT);
            $prep->execute();

            while ($data = $prep->fetch()) {
            ?>

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
            <div class="row text-center">
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