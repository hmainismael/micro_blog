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
                                    $query = 'SELECT * FROM messages WHERE id='.$_GET['id'];
                                    $stmt = $pdo->query($query);

                                    while ($data = $stmt->fetch()) {
                                            $contenu=$data['contenu'];
                                            }
                                        }
                                ?>
                            <textarea id="message" name="message" class="form-control" placeholder="Message"><?php  if(isset($contenu) && !empty($contenu)) {echo $contenu;  } ?></textarea>                  
                            <input type="hidden" name="id" value="<?php if(isset($_GET['id']) && !empty($_GET['id'])) { echo $_GET['id'];} ?>">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
                    </div>                        
                </form>
            </div>


            <?php
            $query = 'SELECT * FROM messages ORDER BY date desc';
            $stmt = $pdo->query($query);

            while ($data = $stmt->fetch()) {
            ?>

            <div class="row">
            	<blockquote class="col-md-12">
                    <div class="col-md-7">
            		  <?= $data['contenu'] ?>
                    </div>
                    <div class="col-md-2 col-sm-2">
                      <?= date("d/m/y H:i:s", $data['date']) ?>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <a href="suppr_message.php?id=<?php echo $data['id'] ?>"  class="btn btn-danger">Supprimer</a>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <a href="index.php?id=<?php echo $data['id'] ?>"  class="btn btn-primary">Modifier</a>
                    </div>
            	</blockquote>
            </div>

	        <?php
             }
            ?>

<?php include('includes/bas.inc.php'); ?>