console.log("front/favoriteproducts.js");

let res = siteurl + "module/favoriteproducts/json_favoriteproducts";
res = res.replace("/modules", "");

$.get(res, function (data) {
  $.each(eval(data.replace(/w/, "")), function (i, item) {
    $("#cb" + item.id_product).attr("checked", "checked");
  });
});
