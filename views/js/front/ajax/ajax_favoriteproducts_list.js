console.log('ajax_favoriteproducts_list.js');

$('article .addstar').click(function () {
    $(this).hide();

    var str = $(this).val();
    console.log('ss' + str);
});



$(document).on('click', '#checkbox_all', function () {
    $('.check').not(this).prop('checked', this.checked);
    const $this = $('.checkall');
    $this.toggleClass('changetext');
    if ($this.hasClass('changetext')) {
        $this.text('UNCHECKBOX ALL');
    } else {
        $this.text('CHECKBOX ALL');
    }
});


$(document).on('change', '.check', function () {
    if ($('.check:checked').length == $('.check').length) {
        $('#checkbox_all').prop('checked', true);
        const $this = $('.checkall');
        $this.toggleClass('changetext');
        if (!$this.hasClass('changetext')) {
            $this.text('CHECKBOX ALL');
        } else {
            $this.text('UNCHECKBOX ALL');
        }
    } else {
        $('#checkbox_all').prop('checked', false);
        const $this = $('.checkall');
        $this.toggleClass('changetext');
        if (!$this.hasClass('changetext')) {
            $this.text('CHECKBOX ALL');
        }
    };
});