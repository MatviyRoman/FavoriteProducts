console.log("ajax_favoriteproducts_list.js");

$(document).on("click", "#checkbox_all", function () {
  $(".check").not(this).prop("checked", this.checked);
  const $this = $(".checkall");
  $this.toggleClass("changetext");
  if ($this.hasClass("changetext")) {
    $this.text("UNCHECKBOX ALL");
  } else {
    $this.text("CHECKBOX ALL");
  }
});

$(document).on("change", ".check", function () {
  if ($(".check:checked").length == $(".check").length) {
    $("#checkbox_all").prop("checked", true);
    const $this = $(".checkall");
    $this.toggleClass("changetext");
    if (!$this.hasClass("changetext")) {
      $this.text("CHECKBOX ALL");
    } else {
      $this.text("UNCHECKBOX ALL");
    }
  } else {
    $("#checkbox_all").prop("checked", false);
    const $this = $(".checkall");
    if ($this.hasClass("changetext")) {
      $this.text("CHECKBOX ALL");
      // $this.toggleClass('changetext');
      $this.removeClass("changetext");
    }
  }
});
