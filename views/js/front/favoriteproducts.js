console.log('front/favoriteproducts.js');

$.get('/module/favoriteproducts/json_favoriteproducts', function (data) {
    // $.each(eval(data.replace(/[\r\n]/, '')), function (i, item) {
    $.each(eval(data.replace(/w/, '')), function (i, item) {
        //console.log(item.id_product);
        $('#cb' + item.id_product).attr('checked', 'checked');
    });
});