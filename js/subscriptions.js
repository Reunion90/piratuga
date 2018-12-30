
$(document).ready(function () {

    function update_subscription() {
        console.log(username);
        $.ajax({
            url: "../loginsystem/getsubscription.php",
            method: "POST",
            data: { tvshow: tvshow, username: username},
            dataType: "json",
            success: function (data) {
                if(data.subscribed){
                    $(".subscribe").text("Série subscrita").addClass("subscribed");
                }
                if(data.unsubscribed){
                    $(".subscribe").text("Subscrever esta série").removeClass("subscribed");
                }
                updateHandlers();
            }
        });
    }
    
    update_subscription();

    function updateHandlers(){
        if(!$(".subscribe").hasClass("subscribed")){
            $(".subscribe").click(function(){
                $.ajax({
                    url: "../loginsystem/subscribe.php",
                    method: "POST",
                    data: { tvshow: tvshow, username: username},
                }).done(function(){
                    update_subscription();
                });
            });
        } else {
            $(".subscribe").click(function(){
                console.log("unsubc");
                $.ajax({
                    url: "../loginsystem/unsubscribe.php",
                    method: "POST",
                    data: { tvshow: tvshow, username: username},
                }).done(function(){
                    update_subscription();
                });
            });
        }
    }
});