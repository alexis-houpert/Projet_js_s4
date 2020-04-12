

(function() {
    'use strict';
    $(document).ready(function () {

        loadCheckBox();
        load_Content();
        });



}) ();



function load_Content () {
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {


        $.get("../json/cocktail-img.json", function (content2) {
        }).done(function (content2) {



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
            content[i]['category'] = content[i]['category'];

        if (content[i]['category'] == undefined)
            content[i]['category'] = '';


        let recap = '';
        for (let y in content[i]['ingredients'])
        {
            recap +=  ' '+ content[i]['ingredients'][y]['ingredient'] + ' '
        }




        $('#list_cocktail').append('<div id="icon" class="card border-primary mb-3" style="max-width: 20rem; margin-left: 10px" wfd-id="72">\n' +
            '                <div class="card-header" style="color: #fd7e14" wfd-id="74">'+ content[i]['glass'] + '</div>\n' +
            '            <div class="card-body" wfd-id="73">\n' +
            '            <h4 class="card-title">' + content[i]['name'] + '</h4>\n' +
            '        <p class="card-text">' + content[i]['category'] + '</p>' +
            '        <p class="text-primary">Ingrédients : ' + recap + ' </p>' +
            '        </div>\n' +
            '        </div>')
            .on('click', '#icon', function () {
                name = $(this).find('h4').text();
                //console.log(name)
                i = nameToIndex(name)
                tabFusion = IndexToIngredients(i);
                linkImgJson = nameToLinkImg(name);

                let accompagnement = '';
                if (content[i]['garnish'] != undefined)
                    accompagnement = content[i]['garnish'] + ' ';

                let glass = '';
                if (content[i]['glass'] != undefined)
                    glass = content[i]['glass'] + ' ';

                let searchParams = new URLSearchParams(window.location.search)
                let param = searchParams.get('id')


                $('#desc_cocktail').fadeOut(500, function () {
                    $(this).empty().html('<div class="card mb-3">\n' +
                        '  <h3 class="card-header">'+ content[i]['name'] +'</h3>\n' +
                        '  <div class="card-body">\n' +
                        '    <h5 class="card-title">'+ glass +'</h5>\n' +
                        '    <h6 class="card-subtitle text-muted">'+ content[i]['category']+'</h6>\n' +
                        '  </div>\n' +
                        '  <img style="height: 200px; width: 100%; display: block;" src='+ content[i]['image'] +' alt="Aucune illustration disponible">\n' +
                        '  <div class="card-body">\n' +
                        '    <p class="card-text">'+ accompagnement +'<br>Preparation : '+ content[i]['preparation']+
                        '</p>\n' +
                        '  </div>\n' +
                        '  <ul id="desc_cocktail_ingredients" class="list-group list-group-flush">\n'+
                        '  </ul>\n' +
                        '  <div class="card-body">\n' +
                        '    <a href="#" class="card-link">'+ param +'</a>\n' +
                        '    <a href="#" class="card-link">Country</a>\n' +
                        '  </div>\n' +
                        '  <div class="card-footer text-muted">\n' +
                        '    Ajouté le \n' +
                        '  </div>\n' +
                        '</div>\n')
                    for (let y in tabFusion)
                    {
                        $(this).find('#desc_cocktail_ingredients').append('<li class="list-group-item">'+ tabFusion[y] +'</li>\n')
                    }
                        $(this).append('<div style="display: none" id="message2" class="alert alert-dismissible alert-success">\n' +
                        '        <button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                        '        <div id="text_message"><strong>Well done!</strong> Connection successful </div>\n' +
                        '    </div>')
                            $(this)
                        .fadeIn(500,function () {

                    })
                })


            })

    }
    console.log('Contenu chargé !');
}





function nameToLinkImg(name) {
    content2 = JSON.parse(localStorage.getItem('cocktailImg'));
        //console.log(name)
        for (y in content2)
        {
            if (content2[y]['name'] == name)
            {
                return  linkImgJson = content2[y]['image'];
            }
        }

}

/**
 * retourne la liste de tous les ingrédients en éliminant les doublons
 * @returns {*[]}
 */

function listIngredient() {
    content = JSON.parse(localStorage.getItem('cocktail'));

    let ingredients = [];
    let copie1 = [];
    let copie2 = [];
    for (let i in content)
    {
        for (let y in content[i]['ingredients'])
        {
            copie1.push(content[i]['ingredients'][y]['ingredient'])
        }
    }
    ingredients = [...new Set(copie1)];
    return ingredients
}

function nameToIndex(name) {
    content = JSON.parse(localStorage.getItem('filterCocktail'));
    for (let i in content)
    {
        if (content[i]['name'] == name)
            return i;
    }
    console.log(name + ' not found in JSON')
}

function IndexToIngredients (i)
{
    content = JSON.parse(localStorage.getItem('filterCocktail'));

    let ingredients = [];
    let volume = [];
    let tabFusion = [];
    for (let y in content[i]['ingredients'])
    {
        ingredients.push(content[i]['ingredients'][y]['ingredient']);
        volume.push(content[i]['ingredients'][y]['amount'] + content[i]['ingredients'][y]['unit'])
        tabFusion.push(ingredients[ingredients.length - 1] + ' - ' +volume[volume.length - 1])
        if (!undefined == content[i]['ingredients'][y]['label'])
            tabFusion[tabFusion.length - 1] += '<br>' + content[i]['ingredients'][y]['label'];
    }
    return tabFusion;
}

function loadCheckBox() {
    let ingredients = listIngredient();
    for (let i in ingredients)
    {
        $('#selection').append('<input type="checkbox" class="case" name='+ ingredients[i] +' id="case" ' +
            'style="margin-left: 10px;" /> <label name='+ ingredients[i] +' for="case" style="margin: 10px;">'+ ingredients[i] +'</label> <br>')
    }
    /*for (let i in ingredients)
    {
        $('#selection').append('<div class="custom-control custom-switch">\n' +
            '      <input type="checkbox" class="custom-control-input" name='+ ingredients[i] +' id="customSwitch2" checked="">\n' +
            '      <label class="custom-control-label" for="customSwitch1">'+ ingredients[i] +'</label>\n' +
            '    </div>')
    }*/
}

function cocktailExist(tab) {
    content = JSON.parse(localStorage.getItem('filterCocktail'));

    for (let i in content) {
        let cptContent = 0;
        for (let y in content[i]['ingredients']) {
            for (let z in tab) {
                // Si un meme ingredient est trouvé on compte
                if (tab[z] == content[i]['ingredients'][y]['ingredient'])
                    cptContent++;
            }
        }
        // Si le nombres d'ingédient égaux sur 1 cocktail est égal aux nombre d'ingrédient du cocktail alors ils ont les mêmes ingédients
        if (cptContent == tab.length)
            return true
    }
}
