//Favorite Products Buy All
$(document).ready(function () {
  console.log("front/ajax/ajax_favoriteproducts_buy.js");

  //   $(".multi_add")
  //     .unbind("click")
  //     .click(function () {
  //       // get all checked items
  //       const checked_items = $(".check:checked");

  //       if (checked_items.length == 0) alert(noSelectionTxt);
  //       else {
  //         $.each(checked_items, function (i, item) {
  //           var id_prd = $(item).val(); // val of the checkbox!
  //           ajaxCart.add(
  //             id_prd,
  //             null,
  //             false,
  //             $(item).parent().parent().find(".ajax_add_to_cart_button")
  //           );
  //           // uncheck current element
  //           $(item).removeAttr("checked");
  //         });
  //       }
  //     });

  $("#buyFavoritesProducts")
    .unbind("click")
    .click(function () {
      console.log("#buyFavoritesProducts");
      // get all checked items
      var checked_items = $(".check:checked");

      if (checked_items.length == 0) alert(noSelectItem);
      else {
        $.each(checked_items, function (i, item) {
          $(item).parent().parent().find(".add_to_cart").click();
        });
      }
    });

  //   //for every 'add' buttons...
  //   $(".add_to_cart")
  //     .unbind("click")
  //     .click(function () {
  //       const idProduct = $(this)
  //         .attr("rel")
  //         .replace("nofollow", "")
  //         .replace("ajax_id_product_", "");
  //       const qty = $(this).parent().find(".multi_product_quantity").val();

  //       // if quantity is 0 or NaN, return;
  //       if (qty == 0 || isNaN(qty)) return false;

  //       if ($(this).attr("disabled") != "disabled")
  //         ajaxCart.add(idProduct, null, false, this);
  //       return false;
  //     });

  $("#buyAllProducts").click(function () {
    console.log("click #buyAllProducts");

    $("article, .custom-control, .favoriteproducts-wrapper").remove();
    $(".result").show();
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
      url: "/module/favoriteproducts/ajax_favoriteproducts_buy_all",
      method: "POST",
      data: {
        //product: product
      },
      success: function (data) {
        $("#result").html(data);
      },
    });
  });

  //Favorite Products Buy
  //console.log('front/ajax/ajax_favoriteproducts_del.js');

  $("#buyFavoriteProducts").click(function () {
    console.log("click #buyFavoritesProducts");

    event.preventDefault();
    const check = [];
    $.each($(".check:checked"), function () {
      const item_id = $(this).val();
      //$('#product-' + item_id).remove();
      console.log("buy product " + item_id);
      check.push($(this).val());
    });
    const checked = check.join("##");
    console.log("click #buyFavoritesProducts " + checked);

    if ($("article").length == false) {
      $("article, .custom-control, .favoriteproducts-wrapper").remove();
      $(".result").show();
    }

    $.ajax({
      //  url: '/module/favoriteproducts/ajax_favoriteproducts_buy_favorites',
      url: "/cart.php",
      // url: '{$urls.pages.cart}',
      type: "POST",
      cache: false,
      data: {
        check: check,
      },
      dataType: "html",
      success: function (data) {
        if (data == "DELETES") {
          $(".result")
            .show()
            .text("You have successfully deleted the selected users");
          $(".error").hide();
          updateData();
          return false;
        }
        $(".error").show(function () {
          $(this).text(data);
          console.log("error");
        });
        $("#close").is(function () {
          $(this).text("Close").attr("class", "btn btn-success");
        });
      },
    });
    return false;
  });
});
