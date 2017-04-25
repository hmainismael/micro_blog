{include file='includes/haut.inc.tpl'}
 
            {if $texteRecherche != ''}
            <div class="row text-center" id="btnAfficherAllMessages">
                <a href="index.php" role="button" type="button" class="btn btn-info">Afficher tous les messages</a>
            </div>
            {/if}
            <div class="row text-center" id="zoneDeRecherche">
                <form class="form-horizontal" method="GET" id="form_recherche" action="index.php">   
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
                            <textarea id="message" name="message" class="form-control" placeholder="Message">{$contenu}</textarea>                  
                            <input type="hidden" name="id" value="{$getId}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg" {if !$connected}disabled{/if}>Envoyer</button>
                    </div>                        
                </form>
            </div>

            <div class="row hidden" id="apercuModification"> 
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-2">
                        <span class="label label-info">Aperçu de votre message</span>
                    </div>
                </div>
                <div class="row">   
                    <div class="col-sm-6 col-sm-offset-2">  
                        <div class="alert alert-info" role="alert" id="messageModif">
                        </div>
                    </div>
                </div>              
            </div>


            <!--
                MESSAGES DE LA PAGE AVEC ACTIVATION DES BOUTONS MODIFIER ET SUPPRIMER UNIQUEMENT S'ILS SONT EDITES PAR L'UTILISATEUR CONCERNE
            -->
            {foreach from=$listeMessages item=message}
            <div class="row" style="margin-top:15px">
                <blockquote class="col-md-12">
                    <div class="col-md-7">
                      {$message.contenu_msg}
                    </div>
                    <div class="col-md-2 col-sm-2">
                        {$message.date_msg|date_format:'%d/%m/%y %H:%I:%S'}
                    </div>
                    {if $connected}
                    <div class="col-md-1 col-sm-2">
                        <a href="suppr_message.php?id={$message.id_msg}"  class="btn btn-danger" {if $message.user_id != $id}disabled{/if} >Supprimer</a>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <a href="index.php?id={$message.id_msg}" id="btnModifier" class="btn btn-warning" {if $message.user_id != $id}disabled{/if} >Modifier</a>
                    </div>
                    {/if}
                </blockquote>
            </div>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-4">
                    <button class="btn btn-primary btn-sm btnJaime" type="button">
                      <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> J'aime <span class="badge nbJaime"  data-id={$message.id_msg}>{$message.votes}</span>
                    </button>
                </div>
                <div class="col-sm-2 col-sm-offset-3" id="auteurMsg">
                 <span class="badge" style="font-size:1.0em">Auteur : {$message.pseudo_user|upper}</span>
                </div>
            </div>
            {/foreach}

            <!--
                PAGINATION SITUEE EN BAS DE PAGE
            -->
            <div class="row text-center" id="blocMessages">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-lg">
                    {if $index != 1}
                    <li>
                      <a href="index.php?p={$index-1}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    {/if}

                    {for $i=1 to $nbPages}
                        {if $i eq $index}
                            <li><a href="index.php?p={$i}" id="pageEnCours">{$i}</a></li>
                        {else}
                            <li><a href="index.php?p={$i}">{$i}</a></li>
                        {/if}
                    {/for}

                    {if $index != $nbPages}
                    <li>
                      <a href="index.php?p={$index+1}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                     {/if}
                  </ul>
                </nav>
            </div>


{include file='includes/bas.inc.tpl'}