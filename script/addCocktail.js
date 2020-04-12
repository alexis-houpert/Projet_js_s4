(function() {
    'use strict';
    $(document).ready(function () {
        $('#add_form').on('click',function () {
            let content = JSON.parse(localStorage.getItem('cocktail'));

            let tab = [];

            $('.case').each(function () {
                if($(this).is(':checked'))
                {
                    tab.push($(this).attr('name'));
                }
            })

            if (!tab.length > 0) {
                // déclencher message d'alerte dans le cadre
                console.log('aucun ingrédient séléctionné')
                $('#message').addClass('alert-danger').removeClass('alert-info');
                $('#text_message').empty().append('<strong>Erreur !  </strong>Aucun ingrédient séléctionné');
                $("#message").fadeIn(500);
            }
            else if (cocktailExist(tab))
            {
                console.log('A partir des ingrédients séléctionnés, nous remarquons que le cocktail existe déjà')
                $('#message').addClass('alert-info').removeClass('alert-danger');
                $('#text_message').empty().append('<strong>Erreur !  </strong>Il existe un cocktail ayant les même ingrédients, utilisez la recherche par ingrédient !');
                $("#message").fadeIn(500);
            }
            else
            {
                let searchParams = new URLSearchParams(window.location.search)
                let param = searchParams.get('id')

                $('#desc_cocktail').fadeOut(500, function () {
                    $(this).empty().html('<form action="#" method="post" id="formAddCocktail">' +
                        '<div class="card mb-3">\n' +
                        '  <h3 class="card-header">'+

                        '<div class="form-group">\n' +
                        '  <label class="col-form-label col-form-label-sm" for="inputSmall">Nom du cocktail</label>\n' +
                        '  <input class="form-control form-control-sm" type="text" placeholder="Cocktail Name" id="name">\n' +
                        '</div>\n'

                        +'</h3>\n' +
                        '  <div class="card-body">\n' +
                        '    <h5 class="card-title">'+

                        '<div class="form-group">\n' +
                        '  <label class="col-form-label col-form-label-sm" for="inputSmall">Verre</label>\n' +
                        '  <input class="form-control form-control-sm" type="text" placeholder="Glass" id="glass">\n' +
                        '</div>\n'

                        +'</h5>\n' +
                        '    <h6 class="card-subtitle text-muted">'+

                        '<div class="form-group">\n' +
                        '  <label class="col-form-label col-form-label-sm" for="inputSmall">Catégorie</label>\n' +
                        '  <input class="form-control form-control-sm" type="text" placeholder="Category" id="category">\n' +
                        '</div>\n'

                        +'</h6>\n' +
                        '  </div>\n' +

                        '<div class="form-group">\n' +
                        '  <label class="col-form-label col-form-label-sm" for="inputSmall">Lien vers l\'image</label>\n' +
                        '  <input class="form-control form-control-sm" type="text" placeholder="lien" id="link">\n' +
                        '</div>'+

                        '  <div class="card-body">\n' +
                        '    <p class="card-text">' +

                        '<div class="form-group">\n' +
                        '  <label class="col-form-label col-form-label-sm" for="inputSmall">Garniture</label>\n' +
                        '  <input class="form-control form-control-sm" type="text" placeholder="garnish" id="garniture">\n' +
                        '</div>'+

                        '<div class="form-group">\n' +
                        '      <label for="exampleTextarea">Préparation</label>\n' +
                        '      <textarea class="form-control" id="preparation" rows="3" placeholder="Be concise"></textarea>\n' +
                        '    </div>' +

                        '</p>\n' +
                        '  </div>\n' +
                        '  <ul class="list-group list-group-flush">\n'+
                        // INGREDIENTS
                        '  </ul>\n' +
                        '  <div id="author" class="card-body">\n' + param+
                        '  </div>\n' +
                        '  <div class="card-footer text-muted" id="date">\n 12/04/2020'+
                        '  </div>\n' +
                        '</div>\n' +
                        '<button type="submit" name="addSubmit" class="btn btn-outline-primary">Ajouter</button>' +
                        '</form>')
                    for (let y in tab)
                    {
                        $(this).find('ul').append('    <li id="ingredient" name='+ tab[y] +' class="list-group-item">'+ tab[y] +'</li>\n')
                    }
                        $(this).fadeIn(500,function () {
                            var request;

                            $('#formAddCocktail').submit(function (e) {
                                e.preventDefault();
                                if (request) {
                                    request.abort();
                                }
                                var $inputs = $(this).find("input, select, button, textarea, submit");
                                $inputs.prop("disabled", true);

                                var ingredients = []
                                $('#ingredient').each(function () {
                                    ingredients.push($(this).attr('name'))
                                })

                                console.log($('#name').val());
                                console.log($('#glass').val());
                                console.log($('#category').val());
                                console.log($('#preparation').val())
                                console.log(ingredients)

                                request = $.ajax({
                                    url: '../json/addCocktail.php',
                                    type: 'post',
                                    data: {
                                        'name' : $('#name').val(),
                                        'glass' : $('#glass').val(),
                                        'category' : $('#category').val(),
                                        'garniture' : $('#garniture').val(),
                                        'preparation' : $('#preparation').val(),
                                        'author' :  $('#author').text(),
                                        'date' : $('#date').val(),
                                        'image' : $('#link').val(),
                                        'ingredients' : JSON.stringify(ingredients)
                                    }
                                }).done(function (data){
                                    console.log(data)
                                    console.log("Ajax request done !");
                                    console.log(data.success)
                                    if (data.success == true)
                                    {
                                        $('#message').addClass('alert-success').removeClass('alert-danger');
                                        $('#text_message').empty().append('<strong>Bravo !  </strong>Cocktail envoyé !');
                                        $("#message").fadeIn(500);

                                        setTimeout(function () {
                                            load_Content();
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
                        })
                })
            }


        })

    })
}) ();