//Favorite Products Delete Single
$("article .addstar").click(function () {
  const item_id = $(this).val();
  $("#product-" + item_id).remove();
  console.log("remove product " + item_id);

  if ($("article").length == false) {
    $("article, .custom-control, .favoriteproducts-wrapper").remove();
    $(".result").show();
  }
});

//Favorite Products Delete All
$(document).ready(function () {
  console.log("front/ajax/ajax_favoriteproducts_del.js");

  $("#delAllProducts").click(function () {
    $("article, .custom-control, .favoriteproducts-wrapper").remove();
    $(".result").show();
    var product = [];
    $(this).each(function () {
      if ($(this).is(":checked")) {
        product.push($(this).val());
        //console.log('add product ' + product);
      } else {
        product.push($(this).val());
        //console.log('del product ' + product);
      }
    });

    //product = product.toString();

    let res = siteurl + "module/favoriteproducts/ajax_favoriteproducts_del_all";
    res = res.replace("/modules", "");

    $.ajax({
      url: res,
      method: "POST",
      data: {
        //product: product
      },
      success: function (data) {
        $("#result").html(data);
      },
    });
  });
});

//Favorite Products Delete
$(document).ready(function () {
  //console.log('front/ajax/ajax_favoriteproducts_del.js');

  $("#delFavoritesProducts").click(function () {
    console.log("#delFavoritesProducts");
    event.preventDefault();
    const check = [];
    $.each($(".check:checked"), function () {
      const item_id = $(this).val();
      $("#product-" + item_id).remove();
      console.log("remove product " + item_id);
      check.push($(this).val());
    });
    const checked = check.join("##");
    console.log("click #deletee " + checked);

    if ($("article").length == false) {
      $("article, .custom-control, .favoriteproducts-wrapper").remove();
      $(".result").show();
    }

    let res =
      siteurl + "module/favoriteproducts/ajax_favoriteproducts_del_favorites";
    res = res.replace("/modules", "");

    $.ajax({
      url: res,
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
