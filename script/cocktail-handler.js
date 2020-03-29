

(function() {
    console.log('start cocktail-handler.js')
    'use strict';
    $(document).ready(function () {
        load_Content();
        });

    $(document).ready(function () {
        $('#search_form').on('click',function () {
            console.log('Clique sur searchBox')
            let nbFilter = 0;

            // On compte le nombre de cases
            let cases = $('#selection.case');
            cases.each(function () {
                nbFilter =  nbFilter + 1;
            })


            let filterArray = []; //array de string pour les ingrédients du cocktail
            filterArray.length = nbFilter;

            console.log($('#selection.label:first').name());

            for (i in nbFilter - 1)
            {

                if (cases.eq(i).checked)
                    filterArray[i] = $('#selection.label').eq(i).val;

            }
            let list_cocktail = search_Cocktail(filterArray);
            load_searchBox(list_cocktail);
        })
    });
}) ();

function search_Cocktail(filterArray) {
    let list_cocktail = [];
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {
        for (let i in content) {
            for (y in content[i]['ingredients']){
                for (z in filterArray) {
                    if (content[i][ingredients][y]['ingredient'] == filterArray[z])
                        list_cocktail.push(content[i]['name']);
                }
            }
        }
    });
    console.log('Nombre de cocktail correspondant aux filtres: '+ list_cocktail.length);
    return list_cocktail;
}

function load_searchBox(nameList_Cocktail) {
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {
        let sortContent = [];
        for (i in content)
        {
            if(content[i]['name'] == nameList_Cocktail[i])
                sortContent.push(content[i]);
        }
        display(sortContent)
    });
}


function load_Content () {
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {
        console.log('Requête pour le chargement de tous les cocktails');
           display(content);
    });

}

function display(content) {
    $('#list_cocktail').empty();
    for (let i in content)
    {

        if (content[i]['category'] != undefined)
            content[i]['category'] = ' - ' + content[i]['category'];

        if (content[i]['category'] == undefined)
            content[i]['category'] = '';

        $('#list_cocktail').append('<div class="card border-primary mb-3" style="max-width: 20rem; margin-left: 10px" wfd-id="72">\n' +
            '                <div class="card-header" style="color: #fd7e14" wfd-id="74">'+ content[i]['name'] + '</div>\n' +
            '            <div class="card-body" wfd-id="73">\n' +
            '            <h4 class="card-title">' + content[i]['glass'] + content[i]['category'] + '</h4>\n' +
            '        <p class="card-text">' + content[i]['ingredients'][0]['ingredient'] + '</p>' +
            '        <p class="text-primary">' + content[i]['preparation'] + '</p>' +
            '        </div>\n' +
            '        </div>');
    }
    console.log('Contenu chargé !');
}