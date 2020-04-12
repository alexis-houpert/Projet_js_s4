(function() {
    'use strict';
    $(document).ready(function () {


        $('.case').prop('checked', false);

        $('#search_form').on('click',function () {
            let content = JSON.parse(localStorage.getItem('cocktail'));

            let tab = [];

            $('.case').each(function () {
                if($(this).is(':checked'))
                {
                    tab.push($(this).attr('name'));
                }
            })

            if (!tab.length > 0) {
                // the array is defined and has at least one element
                localStorage.setItem('filterCocktail', JSON.stringify(content));
            }
            else {
                let jsonfiltered = [];
                for (let i in content) {
                    let cpt = 0;
                    for (let y in content[i]['ingredients']) {
                        for (let z in tab) {
                            if (tab[z] == content[i]['ingredients'][y]['ingredient'])
                            {
                                cpt ++
                            }
                        }
                    }
                    if (tab.length - 1 == cpt)
                        jsonfiltered.push(content[i]);
                }
                localStorage.setItem('filterCocktail', JSON.stringify(jsonfiltered));
            }
                display();
        })

    })
    }) ();

