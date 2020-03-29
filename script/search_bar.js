(function() {
    console.log('ça marche ?')
    'use strict';
    $(() => {
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#AllPlayer div").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
}) ();