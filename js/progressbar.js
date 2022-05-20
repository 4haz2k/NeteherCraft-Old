window.onload = function onLoad() {
    $.ajax({
        type: 'POST',
        url: '/events.php',
        data: {
            action: "gifts"
        },
        success: function (response) {
            var data = JSON.parse(response);
            var mcrate_rating = new ProgressBar.Circle(mcrate, {
                color: '#ffea82',
                trailColor: '#eee',
                trailWidth: 1,
                duration: 3000,
                easing: 'bounce',
                strokeWidth: 10,
                from: {color: '#7fe139', a:0},
                to: {color: '#ffa651', a:1},
                // Set default step function for all animate calls
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color);
                }
            });

            mcrate_rating.animate(data[0].mcrate);  // Number from 0.0 to 1.0

            var mctop_rating = new ProgressBar.Circle(mctop, {
                color: '#ffea82',
                trailColor: '#eee',
                trailWidth: 1,
                duration: 3000,
                easing: 'bounce',
                strokeWidth: 10,
                from: {color: '#7fe139', a:0},
                to: {color: '#ffa651', a:1},
                // Set default step function for all animate calls
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color);
                }
            });

            mctop_rating.animate(data[0].mctop);  // Number from 0.0 to 1.0
        }
    });

    $.ajax({
        type: 'POST',
        url: '/events.php',
        data: {
            action: "gifts_load"
        },
        success: function (response) {
            var data = JSON.parse(response);
            $('#gifts').html(data['0'].data);
        }
    });
};

function TakeGift(id){
    $.ajax({
        type: 'POST',
        url: '/events.php',
        data: {
            action: "take_gift",
            id: id
        },
        success: function (response) {
            var result = JSON.parse(response);
            if (result[0].status === "Success") {
                if($("#nether_info_block").css('display') == 'none') {
                    $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    if(id === '1'){
                        mcrate_rating.animate(0);
                    }
                    else if(id === '2'){
                        mctop_rating.animate(0);
                    }
                }
                else {
                    $("#nether_info_block").html(result[0].message);
                }
            }
            else if(result[0].status === "Fail"){
                if($("#nether_info_block").css('display') == 'none') {
                    $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                }
            }
        }
    });
}

var Gifts = {

    BuyGift: function(element) {
        var element = $(element);
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: "buy_gift",
                id: element.attr('gift_id'),
                gift_amount: element.parent().children('input').val()
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result[0].status === "Success") {
                    if ($("#nether_info_block").css('display') == 'none') {
                        $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    } else {
                        $("#nether_info_block").html(result[0].message);
                    }
                } else if (result[0].status === "Fail") {
                    if ($("#nether_info_block").css('display') == 'none') {
                        $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    }
                }
            }
        });
    }
}
