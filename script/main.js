(function() {
    'use strict';
    $(() => {
        $.ajax({
            url: '/json/is_connected.php',
            methode: 'get'
        }).done(function (data) {
            if (data.success)
            {
                $('body').append(
                    $('<button />')
                        .html()
                        .on('click', function () {
                            $.ajax({
                                url: '/json/logout.php',
                                methode: 'get'
                            }).done(function () {
                                window.location.href = '/login.html';
                            });
                        })
                )
            }else {
                window.location.href = '/login.html';
            }
        }).fail(function () {

        })

    })
}) ();