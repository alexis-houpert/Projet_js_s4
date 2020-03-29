(function() {
    'use strict';
    $(() => {
        $('#mail-submit').submit(function (e)
        {
            e.preventDefault();

            let id = $("#mail-id").val();
            let mdp = $("#mail-mdp").val();


            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('methode'),
                data: {
                    id : id,
                    mdp : mdp
                }),
                dataType: 'json'
            }).done(function (data) {
                if (data.success === true)
                {
                    $("#message").html("<p class='invalid-feedback'>Vous avez été connecté avec succès !</p>");
                    window.location.href = '/view/userpage.php';
                    console.log("Connexion réussi");
                }
                else
                {
                    $("#message").html("<p class='invalid-feedback'>L'identifiant et le mdp sont incorrects !</p>");

                }
            }).fail(function () {
                $("#message").html("<p class='invalid-feedback'>Erreur lors de la connexion...</p>");
            });
            return false;
        })
    });
}) ();