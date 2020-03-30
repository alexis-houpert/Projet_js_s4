

(function() {
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

    $(".card-title").hide();
    $('.text-primary').hide();
    $('.card-text').hide();
    $('.card-body').hover(function () {
        $('.card-text').show(500);
        $('.text-primary').show(500);
        $('.card-title').show(500);
    })//hover
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
        console.log('l\'appel de display doit être modifié');
        //display(sortContent)
    });
}


function load_Content () {
    $.get("../json/cocktail.json", function (content) {
        console.log("get JSON");
    }).done(function (content) {
        console.log('get cocktail.json')
        load_Content2(content);
    });

}

function load_Content2(content) {
    $.get("../json/cocktail-img.json", function (content2) {
    }).done(function (content2) {
        console.log('Get cocktail-img.json');
        display(content,content2);
    })
}

function display(content,content2) {
    $('#list_cocktail').empty();
    for (let i in content)
    {
        if (content[i]['category'] != undefined)
            content[i]['category'] = ' - ' + content[i]['category'];

        if (content[i]['category'] == undefined)
            content[i]['category'] = '';



        for (y in content2)
        {

                     if (content2[y]['name'] == content[i]['name'])
                     {

                         var linkImgJson = content2[y]['image'];
                     }

        }

        $('#list_cocktail').append('<div class="card border-primary mb-3 box-cocktail" wfd-id="72">\n' +
            '                <div class="card-header" style="color: #fd7e14" wfd-id="74">'+ content[i]['name'] + '</div>\n' +
            '            <div class="card-body"  style="//background-image: url(' + linkImgJson + ');" wfd-id="73">\n' +
            '            <h4 class="card-title">' + content[i]['glass'] + content[i]['category'] + '</h4>\n' +
            '        <p class="card-text">' + content[i]['ingredients'][0]['ingredient'] + '</p>' +
            '        <p class="text-primary">' + content[i]['preparation'] + '</p>' +
            '        </div>\n' +
            '        </div>');
    }
    console.log('Contenu chargé !');
}
