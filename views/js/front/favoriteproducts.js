console.log("front/favoriteproducts.js");

//const url = window.location.href + 'json_favoriteproducts';
// const match = url.match('my-account');
// let res;
// if(match) {
//     res = url.replace('/my-account','/module/favoriteproducts/');
// } else {
//    res = url.replace('/products','/');
// }

let res = siteurl + "module/favoriteproducts/json_favoriteproducts";
res = res.replace("/modules", "");

$.get(res, function (data) {
  // $.each(eval(data.replace(/[\r\n]/, '')), function (i, item) {
  $.each(eval(data.replace(/w/, "")), function (i, item) {
    //console.log(item.id_product);
    $("#cb" + item.id_product).attr("checked", "checked");
  });
});
