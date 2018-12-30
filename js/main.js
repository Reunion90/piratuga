

$(document).ready(function () {
    $('#notif-counter').css({ opacity: 0 })
    $('.menu').click(function (e) {
        e.stopPropagation();
        $('#main_nav').toggleClass('active');
    });

    $(document).click(function () {
        $('#main_nav').removeClass('active');
    });

    function load_unseen_notification(view = '') {
        $.ajax({
            url: "../loginsystem/fetch.php",
            method: "POST",
            data: { view: view, user: username},
            dataType: "json",
            success: function (data) {
                $('#notif-content').html(data.notification);
                if (data.unseen_notification > 0) {
                    $('#notif-counter')
                        .css({ opacity: 0 })
                        .text(data.unseen_notification.toString())
                        .css({ top: '-10px' })
                        .animate({ top: '-2px', opacity: 1 }, 500);
                }
            }
        });
    }

    load_unseen_notification();

    $('#notif-button').click(function () {
        load_unseen_notification('yes');
        $('#notif-counter').fadeOut('slow');
        $('#notifications').fadeToggle('fast', 'linear', function () {
            if ($('#notifications').is(':hidden')) {
            }
        });
        return false;
    });

    setInterval(function () {
        load_unseen_notification();;
    }, 5000);
});

function newsletterSubscribe() {
    $('.sign_up_form').submit();
}

function search() {
    $('#search-form').submit();
}

var allowSubmit = false;

function requestSubmit() {
    $('.sign_up_form').submit();
}