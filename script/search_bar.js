(function() {
    console.log('ça marche ?')
    'use strict';
    $(document).ready(function () {
    $("#search").on("click", function() {
        var value = $(this).val().toLowerCase();
        $("#AllPlayer div").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
}) ();