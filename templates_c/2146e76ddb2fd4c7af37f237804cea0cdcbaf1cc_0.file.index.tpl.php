<?php
/* Smarty version 3.1.30, created on 2017-02-28 16:21:24
  from "C:\wamp\www\IUT\micro_blog_smarty\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58b595740edd35_14404586',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2146e76ddb2fd4c7af37f237804cea0cdcbaf1cc' => 
    array (
      0 => 'C:\\wamp\\www\\IUT\\micro_blog_smarty\\templates\\index.tpl',
      1 => 1488294915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:includes/haut.inc.tpl' => 1,
    'file:includes/bas.inc.tpl' => 1,
  ),
),false)) {
function content_58b595740edd35_14404586 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\wamp\\www\\IUT\\micro_blog_smarty\\tpl\\plugins\\modifier.date_format.php';
$_smarty_tpl->_subTemplateRender("file:includes/haut.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 
            <?php if ($_smarty_tpl->tpl_vars['texteRecherche']->value != '') {?>
            <div class="row text-center" style="margin-bottom:15px">
                <a href="index.php" role="button" type="button" class="btn btn-info">Afficher tous les messages</a>
            </div>
            <?php }?>
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
                            <textarea id="message" name="message" class="form-control" placeholder="Message"><?php echo $_smarty_tpl->tpl_vars['contenu']->value;?>
</textarea>                  
                            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['getId']->value;?>
">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success btn-lg" <?php if (!$_smarty_tpl->tpl_vars['connected']->value) {?>disabled<?php }?>>Envoyer</button>
                    </div>                        
                </form>
            </div>


            <!--
                MESSAGES DE LA PAGE AVEC ACTIVATION DES BOUTONS MODIFIER ET SUPPRIMER UNIQUEMENT S'ILS SONT EDITES PAR L'UTILISATEUR CONCERNE
            -->
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['listeMessages']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
            <div class="row" style="margin-top:15px">
                <blockquote class="col-md-12">
                    <div class="col-md-7">
                      <?php echo $_smarty_tpl->tpl_vars['message']->value['contenu_msg'];?>

                    </div>
                    <div class="col-md-2 col-sm-2">
                        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['message']->value['date_msg'],'%d/%m/%y %H:%I:%S');?>

                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['connected']->value) {?>
                    <div class="col-md-1 col-sm-2">
                        <a href="suppr_message.php?id=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_msg'];?>
"  class="btn btn-danger" <?php if ($_smarty_tpl->tpl_vars['message']->value['user_id'] != $_smarty_tpl->tpl_vars['id']->value) {?>disabled<?php }?> >Supprimer</a>
                    </div>
                    <div class="col-md-1 col-sm-2">
                        <a href="index.php?id=<?php echo $_smarty_tpl->tpl_vars['message']->value['id_msg'];?>
"  class="btn btn-primary" <?php if ($_smarty_tpl->tpl_vars['message']->value['user_id'] != $_smarty_tpl->tpl_vars['id']->value) {?>disabled<?php }?> >Modifier</a>
                    </div>
                    <?php }?>
                </blockquote>
            </div>
            <div class="row text-center" style="color:blue">
                <span class="badge" style="font-size:1.2em">Auteur : <?php echo mb_strtoupper($_smarty_tpl->tpl_vars['message']->value['pseudo_user'], 'UTF-8');?>
</span>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


            <!--
                PAGINATION SITUEE EN BAS DE PAGE
            -->
            <div class="row text-center" style="margin-top:15px">
                <nav aria-label="Page navigation">
                  <ul class="pagination pagination-lg">
                    <?php if ($_smarty_tpl->tpl_vars['index']->value != 1) {?>
                    <li>
                      <a href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['index']->value-1;?>
" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                      </a>
                    </li>
                    <?php }?>

                    <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['nbPages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nbPages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
                        <?php if ($_smarty_tpl->tpl_vars['i']->value == $_smarty_tpl->tpl_vars['index']->value) {?>
                            <li><a href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" style="color:red"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
                        <?php } else { ?>
                            <li><a href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a></li>
                        <?php }?>
                    <?php }
}
?>


                    <?php if ($_smarty_tpl->tpl_vars['index']->value != $_smarty_tpl->tpl_vars['nbPages']->value) {?>
                    <li>
                      <a href="index.php?p=<?php echo $_smarty_tpl->tpl_vars['index']->value+1;?>
" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                      </a>
                    </li>
                     <?php }?>
                  </ul>
                </nav>
            </div>


<?php $_smarty_tpl->_subTemplateRender("file:includes/bas.inc.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
