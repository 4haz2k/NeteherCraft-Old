var NetherShop = {
    add_to_cart: function (element) { // DONE bug: not displaying img in custom
        var element = $(element);
        var button = $(".nether-green-pitted-button").offset(); // Метод позволяет получить текущее положение элемента относительно документа
        var form = $(element.parent()).parent();
        var img = form.children('.nether-item-icon').children('img'); // получает изображение
        var id_img = img.attr('id'); // id у изображения
        var pos = img.position();
        var get_all_img = $(".clone_dibl_udal");
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'add_to_cart',
                block_amount: element.parent().children('input').val(),
                block_id: element.attr('block_id')
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].status === 'Success') {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(result[0].data.message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(result[0].data.message);
                }

                if (result[0].status === 'Success') {
                    $("#cart_item_amount").html(result[0].data.count_items);
                    $("#cart_price").html(result[0].data.cart_sum);

                    img.clone().attr({'class': 'clone_dibl_udal'}).appendTo("#" + img.attr('id') + "_block").attr({'id': "clone_" + img.attr('id')}).css({
                        'width': '50px',
                        'height': '50px',
                        'position': 'absolute',
                        'left': pos.left,
                        'top': pos.top,
                        'z-index': "9999999999"
                    }).fadeIn(300)
                        .animate({top: button.top, left: button.left}, 500, function () {
                            $("#clone_" + id_img).fadeOut(300, function () {
                                $("#clone_" + id_img).remove()
                            });
                        });
                    for (i = 0; i < get_all_img.length; ++i) get_all_img.remove();
                }
            }
        });
    },

    sort_items: function (category_id) { // DONE
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'sort_items',
                category_id: category_id,
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                $("#item_list").html(result[0].data.items);
                $("#sort_list").html(result[0].data.category);

                window.dispatchEvent(new Event('lazy'));

                $('.exshop-item-name span').each(function () {
                    NetherShop.resizeTitle(this);
                });
            }
        });
    },

    resizeTitle: function (element) { //DONE MB
        if ($(element).width() > 190 || $(element).height() > 20) {
            var fontsize = $(element).parent().css('font-size');
            $(element).parent().css('fontSize', parseFloat(fontsize) - 0.2);
            this.resizeTitle(element);
        }
    },

    show_ench_info: function (name) { // реализовать

        var ench_item = $(name).attr('ench_item');

        var ench_info_block = $(name).children(".exshop-ench-relative-block").children("#exshop_enchantment_block");

        if ($(name).hover()) ench_info_block.css({'display': 'block'});

        $(name).mouseleave(function () {
            ench_info_block.fadeOut(300);
        });
    },

    get_cart: function () { // DONE
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'get_cart'
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].status === "Success") {
                    $("#cart").html(result[0].data.items);
                    $("#cart_price").html(result[0].data.cart_sum);
                    $("#cart_item_amount").html(result[0].data.count_items);
                    $("#balance").html(result[0].data.balance);
                    $("#cart_price_footer").html(result[0].data.cart_sum);
                }
            }
        });
    },

    generate_menu: function (page) {
        $.ajax({
            type: 'POST',
            url: '/engine/ajax/exshop/ajax.php',
            data: {
                page: page,
                action: 'generate_menu'
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result['menu'].length > 0) {
                    $("#exshop_menu").html(result['menu']);
                }
            }
        });
    },

    delete_item: function (element) { // DONE
        var element = $(element);
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'delete_cart_item',
                block_amount: element.attr('block_amount'),
                block_id: element.attr('block_id')
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].status === "Success") {
                    $("#cart_price").html(result[0].data.cart_sum);
                    $("#cart_item_amount").html(result[0].data.count_items);
                    $("#balance").html(result[0].data.balance);
                    $("#cart_price_footer").html(result[0].data.cart_sum);
                    var newContent = $('<tr style="background: #ff00009c; box-shadow: 0 15px 15px -15px #da7676, 0 -15px 15px -15px #ff0000b0; height: 62px;"><td colspan="6" style=" text-align: center"><font color="white">Предмет удалён из корзины!</font></td></tr>');
                    element.closest('tr').fadeOut(function () {
                        $(this).replaceWith(newContent.hide());
                        newContent.fadeIn(600).delay(1500).fadeOut(600).html();
                    });
                }
            }
        });
    },

    remove_item_amount: function (element) {
        var element = $(element);
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'remove_item_amount',
                block_amount: element.parent().children('input').val(),
                block_id: element.attr('block_id'),
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].message != null) {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(result[0].message);
                }

                if (result[0].status === "Success") {
                    if (result[0].data.items == null) NetherShop.get_cart();
                    else {
                        var newContent = $('<tr style="background: #ff00009c; box-shadow: 0 15px 15px -15px #da7676, 0 -15px 15px -15px #ff0000b0; height: 62px;"><td colspan="6" style=" text-align: center"><font color="white">Предмет удалён из корзины!</font></td></tr>');
                        element.closest('tr').fadeOut(function () {
                            $(this).replaceWith(newContent.hide());
                            newContent.fadeIn(600).delay(1500).fadeOut(600).html();
                        });
                        $("#cart_price").html(result[0].data.cart_sum);
                        $("#cart_item_amount").html(result[0].data.count_items);
                        $("#balance").html(result[0].data.balance);
                        $("#cart_price_footer").html(result[0].data.cart_sum);
                    }
                }
            }
        });
    },

    add_item_amount: function (element) {
        var element = $(element);
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'add_item_amount',
                block_amount: element.parent().children('input').val(),
                block_id: element.attr('block_id')
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].message != null) {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(result[0].message);
                }
                if (result[0].status === "Success") {
                    NetherShop.get_cart();
                }
            }
        });
    },

    buy_cart_items: function (element) {
        $(element).attr('disabled', 'disabled');
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'buy_cart_items'
            },
            success: function (resp) {
                var result = JSON.parse(resp);
                $(element).removeAttr('disabled');
                if (result[0].status === "Success") {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(result[0].message);
                }

                if (result[0].status === "Success") {
                    $("#cart_item_amount").html('0');
                    $("#cart_price").html(result[0].data.cart_sum);
                    $("#balance").html(result[0].data.balance);
                    $("#cart_price_footer").html(result[0].data.cart_sum);
                    NetherShop.get_cart();
                }
            }
        });
    },

    update_price: function () {

        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'update_price'
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result['info'].length > 0) {
                    if ($("#exshop_info_block").css('display') == 'none') $("#exshop_info_block").html(result['info']).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#exshop_info_block").html(result['info']);
                }

            }
        });

    },
};
window.onload = function() {
    NetherShop.get_cart();
    NetherShop.sort_items('0');
};