(function() {
    'use strict';
    $(() => {
        $('#form-login').submit(function ()
        {
            $('#message').fadeOut();

            $.ajax({
                url: $(this).attr('action'), //on peut ajouter l
                method: $(this).attr('methode'),
                data: $(this).serialize()
            }).done(function (data) {
                if (data.success === true)
                {
                    window.location.href = '../login.php';
                }
                else
                {
                    $('#message').html(data.message).fadeIn();
                }
            }).fail(function () {
                $('body').html('Une erreur réseau est arrivée, veuillez réessayer');
            });
            return false;
        })
    });
}) ();