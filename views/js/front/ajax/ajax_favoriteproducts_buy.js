//Favorite Products Buy All
$(document).ready(function () {
  console.log("front/ajax/ajax_favoriteproducts_buy.js");

  $("#buyAllProducts").click(function () {
    console.log("click #buyAllProducts");

    var check = [];
    $.each($(".check"), function () {
      const item_id = $(this).val();
      check.push($(this).val());
    });

    const checked = check.join(",");
    console.log("click buy " + checked);

    let res = siteurl + "module/favoriteproducts/ajax_favoriteproducts_buy_all";
    res = res.replace("/modules", "");

    $.ajax({
      url: res,
      type: "POST",
      cache: false,
      data: {
        check: checked,
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

    res = siteurl + "cart?action=show";
    res = res.replace("/modules", "");
    window.location = res;

    return false;
  });

  $("#buyFavoritesProducts").click(function () {
    console.log("click #buyFavoritesProducts");
    event.preventDefault();
    const check = [];
    $.each($(".check:checked"), function () {
      const item_id = $(this).val();
      check.push($(this).val());
    });
    const checked = check.join(",");
    console.log("click buy " + checked);

    const checked_items = $(".check:checked");
    if (checked_items.length == 0) alert(noSelectItem);
    else {
      let res =
        siteurl + "module/favoriteproducts/ajax_favoriteproducts_buy_favorites";
      res = res.replace("/modules", "");
      $.ajax({
        url: res,
        type: "POST",
        cache: false,
        data: {
          check: checked,
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

      res = siteurl + "cart?action=show";
      res = res.replace("/modules", "");
      window.location = res;
    }
    return false;
  });
});
