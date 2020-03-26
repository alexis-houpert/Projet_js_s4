(function() {
    'use strict';
    $(() => {
        $('#mail-submit').click(function (event)
        {
            event.preventDefault();

            let id = $("#mail-id").val();
            let mdp = $("#mail-mdp").val();
            let submit = $("#mail-submit").val();

            $.post(
                'login.php', // Un script PHP que l'on va créer juste après
                {
                    id : id,  // Nous récupérons la valeur de nos inputs que l'on fait passer à connexion.php
                    mdp : mdp,
                    submit : submit
                },

                function(data){ // Cette fonction ne fait rien encore, nous la mettrons à jour plus tard
                    if(data == 'Success'){
                        // Le membre est connecté. Ajoutons lui un message dans la page HTML.

                        $("#message").html("<p class='invalid-feedback'>Vous avez été connecté avec succès !</p>");
                    }
                    else{
                        // Le membre n'a pas été connecté. (data vaut ici "failed")

                        $("#message").html("<p class='invalid-feedback'>Erreur lors de la connexion...</p>");
                    }
                    },
               // Nous souhaitons recevoir "Success" ou "Failed", donc on indique text !
            );

            /*$.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('methode'),
                data: JSON.stringify({
                    submit : submit,
                    id : id,
                    mdp : mdp
                }),
                dataType: 'json'
            }).done(function (data) {
                if (data.success === true)
                {
                    window.location.href = '../userpage.php';
                }
                else
                {
                    $('#message').html(data.message).fadeIn();
                }
            }).fail(function () {
                $('body').html('Une erreur réseau est arrivée, veuillez réessayer');
            });
            return false;*/
        })
    });
}) ();