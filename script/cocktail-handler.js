

(function() {
    'use strict';
    $(document).ready(function () {

        load_Content();
        });


}) ();


function load_Content () {
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {


        $.get("../json/cocktail-img.json", function (content2) {
        }).done(function (content2) {

            for (let i in content)
            {
                for (let y in content2)
                {
                    if (content2[y]['name'] == content[i]['name'])
                    {
                        content[i]['image'] = content2[y]['image'];
                    }
                }

            }

            let cache = JSON.stringify(content)
            let cache2 = JSON.stringify(content2)

            localStorage.setItem('cocktail',cache);
            localStorage.setItem('cocktailImg',cache2);
            localStorage.setItem('filterCocktail', cache);

            display();
        })
    });

}



function display() {
    $('#list_cocktail').empty();
    content = JSON.parse(localStorage.getItem('filterCocktail'));
    content2 = JSON.parse(localStorage.getItem('cocktailImg'));
    for (let i in content)
    {
        if (content[i]['category'] != undefined)
            content[i]['category'] = ' - ' + content[i]['category'];

        if (content[i]['category'] == undefined)
            content[i]['category'] = '';

       /* for (y in content2)
        {

            if (content2[y]['name'] == content[i]['name'])
            {

                var linkImgJson = content2[y]['image'];
            }

        } */



        $('#list_cocktail').append('<div class="card border-primary mb-3" style="max-width: 20rem; margin-left: 10px" wfd-id="72">\n' +
            '                <div class="card-header" style="color: #fd7e14" wfd-id="74">'+ content[i]['glass'] + '</div>\n' +
            '            <div class="card-body" wfd-id="73">\n' +
            '            <h4 class="card-title">' + content[i]['name'] + '</h4>\n' +
            '        <p class="card-text">' + content[i]['category'] + '</p>' +
            '        <p class="text-primary">Ingrédients : ' + ingredientsToString(i) + ' </p>' +
            '        </div>\n' +
            '        </div>')
            .on('click', function () {
                $('#desc_cocktail').fadeOut(500, function () {

                    $(this).empty().html('<div class="card mb-3">\n' +
                        '  <h3 class="card-header">Card header</h3>\n' +
                        '  <div class="card-body">\n' +
                        '    <h5 class="card-title">Special title treatment</h5>\n' +
                        '    <h6 class="card-subtitle text-muted">Support card subtitle</h6>\n' +
                        '  </div>\n' +
                        '  <img style="height: 200px; width: 100%; display: block;" src=' + content[i]['image'] + ' alt="Card image">\n' +
                        '  <div class="card-body">\n' +
                        '    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>\n' +
                        '  </div>\n' +
                        '  <ul class="list-group list-group-flush">\n' +
                        '    <li class="list-group-item">Cras justo odio</li>\n' +
                        '    <li class="list-group-item">Dapibus ac facilisis in</li>\n' +
                        '    <li class="list-group-item">Vestibulum at eros</li>\n' +
                        '  </ul>\n' +
                        '  <div class="card-body">\n' +
                        '    <a href="#" class="card-link">Card link</a>\n' +
                        '    <a href="#" class="card-link">Another link</a>\n' +
                        '  </div>\n' +
                        '</div>\n')
                        .fadeIn(500,function () {

                    })
                })

            })
    }
    console.log('Contenu chargé !');
}

function ingredientsToString(i) {
    let content = localStorage.getItem('filterCocktail');
    let string = '';
        for (let z in content[i]['ingredients'])
        {
            if (!z == 0)
                string.concat(' - ');
            string.concat(content[i]['ingredients'][z]['ingredient']);
            console.log(content[i]['ingredients'][z]['ingredient']);
        }
    return string;
}
