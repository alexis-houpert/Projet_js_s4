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
                localStorage.setItem('filterCocktail', '[{}]');
            }
            else {
                let jsonfiltered = [];
                for (let i in content) {
                    for (let y in content[i]['ingredients']) {
                        for (let z in tab) {
                            if (tab[z] == content[i]['ingredients'][y]['ingredient'])
                                jsonfiltered.push(content[i]);
                        }
                    }
                }
                localStorage.setItem('filterCocktail', JSON.stringify(jsonfiltered));
            }
                display();
        })

    })
    }) ();