 //Favorite Products Buy All
 $(document).ready(function () {
     console.log('front/ajax/ajax_favoriteproducts_buy.js');

     $('#delAllProducts').click(function () {

         $('article, .custom-control, .favoriteproducts-wrapper').remove();
         $('.result').show();
         // var product = [];
         // $(this).each(function () {
         //     if ($(this).is(':checked')) {
         //         product.push($(this).val());
         //         //console.log('add product ' + product);
         //     } else {
         //         product.push($(this).val());
         //         //console.log('del product ' + product);
         //     }
         // });

         // product = product.toString();

         $.ajax({
             url: '/module/favoriteproducts/ajax_favoriteproducts_buy_all',
             method: 'POST',
             data: {
                 //product: product
             },
             success: function (data) {
                 $('#result').html(data);
             }
         });
     });
 });



 //Favorite Products Buy
 $(document).ready(function () {

     //console.log('front/ajax/ajax_favoriteproducts_del.js');

     $('#buyFavoritesProducts').click(function () {
         console.log('#buyFavoritesProducts');
         event.preventDefault();
         const check = [];
         $.each($('.check:checked'), function () {
             const item_id = $(this).val();
             //$('#product-' + item_id).remove();
             console.log('buy product ' + item_id);
             check.push($(this).val());
         });
         const checked = check.join('##');
         console.log('click #buyFavoritesProducts ' + checked);


         if ($('article').length == false) {
             $('article, .custom-control, .favoriteproducts-wrapper').remove();
             $('.result').show();
         }

         $.ajax({
             url: '/module/favoriteproducts/ajax_favoriteproducts_buy_favorites',
             type: 'POST',
             cache: false,
             data: {
                 check: check,
             },
             dataType: 'html',
             success: function (data) {
                 if (data == 'DELETES') {
                     $('.result')
                         .show()
                         .text('You have successfully deleted the selected users');
                     $('.error').hide();
                     updateData();
                     return false;
                 }
                 $('.error').show(function () {
                     $(this).text(data);
                     console.log('error');
                 });
                 $('#close').is(function () {
                     $(this)
                         .text('Close')
                         .attr('class', 'btn btn-success');
                 });
             },
         });
         return false;
     });
 });