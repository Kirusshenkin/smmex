
$(function () {
    $('.appearance').change(function () {
        $('.appearance-types div').hide();
        $('.appearance-types div:eq(' + $(this)[0].selectedIndex + ')').show();
    });
});
$('')