$(function () {
    $('#menu_phone').on('click', function (e) {
        e.preventDefault();
        $("#menu li").slideToggle(350);
    });
});
