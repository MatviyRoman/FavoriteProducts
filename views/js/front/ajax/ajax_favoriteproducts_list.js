console.log('ajax_favoriteproducts_list.js');

$("button").click(function () {
    $("p").hide();
});



$(document).on('click', '#checkbox_all', function () {
    $('.check').not(this).prop('checked', this.checked);
});


$(document).on('change', '.check', function () {
    if ($('.check:checked').length == $('.check').length) {
        $('#checkbox_all').prop('checked', true);
    } else {
        $('#checkbox_all').prop('checked', false);
    };
});