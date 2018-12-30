$(document).ready(function () {
    $(".report").click(function () {
        $('.hover_bkgr_fricc').show();
    });
    $('.popupCloseButton').click(function () {
        $('.hover_bkgr_fricc').hide();
    });
});

window.onload = function() {
    var recaptcha = document.forms["repform"]["g-recaptcha-response"];
    recaptcha.required = true;
    recaptcha.oninvalid = function(e) {
        alert("Por favor complete o captcha");
    }
}