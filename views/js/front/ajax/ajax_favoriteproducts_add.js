$(document).ready(function () {
  console.log("front/ajax/ajax_favoriteproducts_add.js");

  $(".addstar").click(function () {
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

    product = product.toString();

    let res = siteurl + "module/favoriteproducts/ajax_favoriteproducts_add";
    res = res.replace("/modules", "");

    $.ajax({
      url: res,
      method: "POST",
      data: {
        product: product,
      },
      success: function (data) {
        $("#result").html(data);
      },
    });
  });
});
