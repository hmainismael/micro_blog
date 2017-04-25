
$(function(){
            /*
                VISUALISER APERCU DU MESSAGE 
            */
            $("#message").on('keyup',function(){

                $("#apercuModification").removeClass('hidden');

                $.get(
                    'apercu_msg.php',
                    {
                        message: $('#message').val(),
                    },
                    function(data){
                        $('#messageModif').html(data);
                });

            });


            /*
                VERIFICATION QUE TOUS LES CHAMPS DU FORMULAIRE D'INSCRIPTION SONT SAISIS
            */
            $("#form_inscription").submit(function(){

                if( $("#nom").val() == '' || $("#prenom").val() == '' || $("#mail").val() == '' || $("#pseudo").val() == '' || $("#motdepasse").val() == '' )
                {
                    $(".msgErreur").html("Tous les champs sont obligatoires !");
                    $(".msgErreur").addClass("alert alert-danger");
                    $(".msgErreur").removeClass("hidden");
                    return false;
                }
                else
                {
                    return true;
                }

            });

            /*
                PARTIE JQUERY UTILISE POUR VERIFIER REMPLISSAGE DES CHAMPS
            */ 

            $("#form_connexion").submit(function(){

                $("#pseudoDIV").removeClass("has-error");
                $("#motdepasseDIV").removeClass("has-error");

                if( $("#pseudo").val() == '')
                {
                    $(".msgErreur").html("Veuillez saisir un pseudo !");
                    $(".msgErreur").addClass("alert alert-danger");
                    $("#pseudoDIV").addClass("has-error");
                    $(".msgErreur").removeClass("hidden");
                    return false;

                }
                else if( $("#motdepasse").val() == '')
                {
                    $("#msgErreur").html("Veuillez saisir un mot de passe !");
                    $("#msgErreur").addClass("alert alert-danger");
                    $("#motdepasseDIV").addClass("has-error");
                    $(".msgErreur").removeClass("hidden");
                    return false;

                }
                else{
                    return true;
                }

            });

            /*
                BOUTON "J'AIME " - INCREMENTATION DE LA VALEUR RECUPEREE COTE SERVEUR
            */
            $('.btnJaime').click(function(){
                var nbJaime;
                var btnJaime= $(this);
                var badgeNbVotes= $(this).find('.nbJaime');
                var ipAddress;

                $.getJSON('getIp.php', function(data){
                    ipAddress = data.ip;
                });

                $.ajax({
                   url : 'votes.php',
                   type : 'POST',
                   data : {
                        id: $(this).find('.nbJaime').data('id'),
                   },
                   success:function(result){
                    if(result != '')
                    {
                        if( ipAddress != result[0].lastIp )
                        {
                            incrementationVotes = parseInt(result[0].votes) + 1;
                            $.ajax({
                               url : 'votes.php',
                               type : 'POST',
                               data : {
                                    id: badgeNbVotes.data('id'),
                                    votes: incrementationVotes,
                                    ip: ipAddress,
                               },
                               success:function(result){
                                if(result.success)
                                {
                                  badgeNbVotes.html(incrementationVotes);
                                  btnJaime.prop('disabled',true);
                                }
                               },
                            });
                        }
                        else
                        {
                            alert('Vous avez déjà voté !');
                        }
                    }
                    else{
                        alert('Erreur lors de la requête');
                    }
                   },
                });

            });

    });
