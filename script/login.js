(function() {
    'use strict';
    $(document).ready(function () {

        var request;

        $('#formconnect').submit(function (e)
        {
            e.preventDefault(e);

            if (request) {
                request.abort();
            }

            var $form = $(this);


            var $inputs = $form.find("input, select, button, textarea, submit");


            $inputs.prop("disabled", true);


            request = $.ajax({
                url: 'login.php',
                type: 'post',
                data: {
                    'submitconnect' : $('#submitconnect').val(),
                    'mailconnect' : $('#email').val(),
                    'mdpconnect' : $('#password').val()
                }
            }).done(function (json){
                console.log(json)
                let data = $.parseJSON(json);
                console.log("Ajax request done !");
                console.log(data.success)
                if (data.success == true)
                {
                    $('#message').addClass('alert-success').removeClass('alert-danger');
                    $('#text_message').empty().append('<strong>Bravo !  </strong>' + data.message);
                    $("#message").fadeIn(500);

                    setTimeout(function () {
                        window.location.href = '/view/userpage.php?id=' + data.pseudo;
                    },2000)
                }
                else
                {
                    $('#message').addClass('alert-danger').removeClass('alert-success');
                    $('#text_message').empty().append('<strong>Erreur !  </strong>' + data.message);
                    $("#message").fadeIn(500);

                }
            }).fail(function (){
                console.error('error with ajax req')

            }).always(function () {
                // Reenable the inputs
                $inputs.prop("disabled", false);
            });
        })
    });
}) ();

