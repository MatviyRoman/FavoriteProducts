$(document).ready(function () {

    console.log('front/ajax/ajax_favoriteproducts_add.js');

    $('.addstar').click(function () {
        var product = [];
        $(this).each(function () {
            if ($(this).is(':checked')) {
                product.push($(this).val());
                //console.log('add product ' + product);
            } else {
                product.push($(this).val());
                //console.log('del product ' + product);
            }
        });

        product = product.toString();
        $.ajax({
            url: '/module/favoriteproducts/ajax_favoriteproducts_add',
            method: 'POST',
            data: {
                product: product
            },
            success: function (data) {
                $('#result').html(data);
            }
        });
    });
});