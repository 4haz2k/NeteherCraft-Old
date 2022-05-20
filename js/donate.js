var NetherDonate = {
    select_duration: function (element, duration) {
        var element = $(element);
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                duration: duration,
                group: $('#selected_status').attr('status'),
                action: 'duration'
            },
            success: function (resp) {
                var result = JSON.parse(resp);
                if (result[0].data.date != null) {
                    $("#group-price").html(result[0].data.price);
                    $("#group-duration").html(result[0].data.date);
                    $('#selected_duration').css("background-color", "#ff971d");
                    $('#selected_duration').attr('id', '');
                    element.css("background-color", "#6da6ee");
                    element.attr('id', 'selected_duration');
                    $('#donate_buy').attr('onclick', 'NetherDonate.buy_donate(\'' + $('#selected_status').attr('status') + '\');');
                } else {$("#nether_info_block").html(result[0].message);}
            }
        });
    },
    buy_donate: function (name_group) {
        var check_visible_info = $("#lk-info").offset();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                duration: $("#selected_duration").val(),
                group: name_group,
                action: 'buy_donate'
            },
            success: function (resp) {
                var result = JSON.parse(resp);
                $("#nether_info_block").html(result[0].message).fadeIn().delay(1200).fadeOut(600, function () {
                    $("#lk-info").removeAttr('style');
                });
            }
        });

    },

}

var NetherKits = {

    config : {
        kit_id : '',
    },
    more : function(number)
    {
        this.config.kit_id = number;
        $.ajax({
            type : 'POST',
            url : '/events.php',
            data : {
                action : 'get_kit',
                kit_id : number
            },
            success : function(resp)
            {
                var result = JSON.parse(resp);
                // $("#kit_popup_price_view_small").empty();
                $("#kit_vote_pop").html("20");
                $("#kit_title").html(result[0].data.title);
                $("#kit_src_image").attr({'src' : result[0].data.image});
                $("#kit_src_image_info").attr({'src' : result[0].data.image});
                $("#kit_items").empty();
                $("#kit_items").html(result[0].data.items); // need to realize
                $("#count_of_votes").html(result[0].data.votes_count);
                $("#kit_summa").html(result[0].data.price);
                $("#end_coins_price").html(result[0].data.price);
                $("#kit_back_background").fadeIn(400);
                $("#end_vote_price").html('0');
                $("#NetherPopupWindowlk.kit").css({
                    'left' : ($(window).width() - $("#NetherPopupWindowlk.kit").width()) / 2,
                    'top' : ($(window).height() - $("#NetherPopupWindowlk.kit").height()) / 2,
                });
                $("#NetherPopupBackgroundlk.kit").fadeIn(600);
                $("#NetherPopupWindowlk.kit").fadeIn(600);
                $("#kit_count_votes").val(null);
                $("#kit_amount").val('1');
            }

        });
    },
    kit_buy : function (){
        var votes = $("#kit_count_votes").val();
        var amount = $("#kit_amount").val();
        $.ajax({
            type : 'POST',
            url : '/events.php',
            data : {
                action : 'kit_buy',
                votes : votes,
                amount : amount,
                kit_id : NetherKits.config.kit_id,
            },
            success : function(resp)
            {
                var result = JSON.parse(resp);
                if (result[0].status == "Success") {
                    $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html()
                } else {
                    $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html()
                }
            }
        });
    },

    calculate_price : function()
    {
        var votes = $("#kit_count_votes").val();
        var amount = $("#kit_amount").val();
        if (amount == null) amount = 1;
        $.ajax({
            type : 'POST',
            url : '/events.php',
            data : {
                action : 'calculate_price',
                votes : votes,
                amount : amount,
                kit_id : NetherKits.config.kit_id,
            },
            success : function(resp)
            {
                var result = JSON.parse(resp);
                $("#count_of_votes").html(result[0].data.count_of_votes);
                $("#kit_count_votes").val(result[0].data.kit_count_votes);
                $("#end_coins_price").html(result[0].data.end_price);
                $("#end_vote_price").html(result[0].data.vote_price);
            }
        });
    },

}
function CloseLKExcaliburPopup() {
    $("#NetherPopupBackgroundlk.kit").fadeOut(600);
    $("#NetherPopupWindowlk.kit").fadeOut(600);
}