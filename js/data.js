$(document).ready(function () {
    GetMain();
    $('body').on("submit", "#promo", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            dataType: 'html',
            data: $(this).serialize(),
            success: function (response) {
                var data = JSON.parse(response);
                if(data[0].status === 'success'){
                    $('#popup').remove();
                    CloseExcaliburPopupFast();
                    $('<div id="NetherPopupBackground" onclick="CloseExcaliburPopup();" style="display: block;"></div>\n' +
                        '    <div id="NetherPopupWindow" style="display: block; left: 0; top: 0;">\n' +
                        '        <div class="NetherPopupImg1"></div>\n' +
                        '        <div class="NetherPopupContent">\n' +
                        '            <div class="NetherPopupTitle">Активация промокода</div>\n' +
                        data[0].message +
                        '        </div>\n' +
                        '        <div class="NetherPopupImg2"></div>\n' +
                        '    </div>').prependTo($(".popup"));
                    $("#NetherPopupWindow").css({
                        'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
                        'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
                    });
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });
})
function GetMain(){
    $.ajax({
        type: 'POST',
        url: '/account/get_data.php',
        dataType: 'html',
        data: $(this).serialize(),
        success: function (response) {
            var data = JSON.parse(response);
            if(data[0].status === 'success') {
                $('#menu').empty();
                $("<!--                            Основные-->\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <span class=\"text\" style=\"color: black; font-size: 22px\">Пополнение баланса</span>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center text\" style=\"font-size: 16px; color: #2f2f2f; margin: 10px 0\">\n" +
                    "                                Ваш текущий баланс <span class=\"account-rectangle\">" + data[0].data.money + "</span> руб\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12\">\n" +
                    "                                <div class=\"row text-center\">\n" +
                    "                                    <div class=\"col-3\" style='cursor: pointer' onclick='PayBlock(300)'>\n" +
                    "                                        <img src=\"../images/account/money1.png\" width=\"90\" alt=\"От 300 руб 10% в подарок!\"><br>\n" +
                    "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 14px\">\n" +
                    "                                            От 300 руб<br>\n" +
                    "                                            <span style=\"color: #008f1f\">10% в подарок!</span>\n" +
                    "                                        </div>\n" +
                    "                                    </div>\n" +
                    "                                    <div class=\"col-3\" style='cursor: pointer' onclick='PayBlock(500)'>\n" +
                    "                                        <img src=\"../images/account/money2.png\" width=\"90\" alt=\"От 500 руб 15% в подарок!\"><br>\n" +
                    "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 14px\">\n" +
                    "                                            От 500 руб<br>\n" +
                    "                                            <span style=\"color: #008f1f\">15% в подарок!</span>\n" +
                    "                                        </div>\n" +
                    "                                    </div>\n" +
                    "                                    <div class=\"col-3\" style='cursor: pointer' onclick='PayBlock(1000)'>\n" +
                    "                                        <img src=\"../images/account/money3.png\" width=\"90\" alt=\"От 1000 руб 25% в подарок!\"><br>\n" +
                    "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 14px\">\n" +
                    "                                            От 1000 руб<br>\n" +
                    "                                            <span style=\"color: #008f1f\">25% в подарок!</span>\n" +
                    "                                        </div>\n" +
                    "                                    </div>\n" +
                    "                                    <div class=\"col-3\" style='cursor: pointer' onclick='PayBlock(3000)'>\n" +
                    "                                        <img src=\"../images/account/money4.png\" width=\"90\" alt=\"От 3000 руб 40% в подарок!\">\n" +
                    "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 14px\">\n" +
                    "                                            От 3000 руб<br>\n" +
                    "                                            <span style=\"color: #008f1f\">40% в подарок!</span>\n" +
                    "                                        </div>\n" +
                    "                                    </div>\n" +
                    "                                </div>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <form action=\"\" id='pay'>\n" +
                    "                                    <input id=\"tokens\" type=\"text\" class=\"account-form\" name=\"balance\" placeholder=\"Сумма к пополнению\">\n" +
                    "                                    <button type=\"submit\" class=\"account_button4 text\" style=\"font-size: 15px; margin-top: -5px\">Пополнить</button>\n" +
                    "                                </form>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center text\" style=\"font-size: 16px; color: #2f2f2f; margin: 10px 0\">\n" +
                    "                                Количество монет <span class=\"account-rectangle\">" + data[0].data.tokens + "</span> монеты\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <form id='trade_tokens' action=''>\n" +
                    "                                    <input id='money' type=\"text\" class=\"account-form\" name=\"balance\" placeholder=\"1 рубль = 100 монет\">\n" +
                    "                                    <button type='submit' class=\"account_button2 text\" style=\"font-size: 15px; margin-top: -5px\">Обменять</button>\n" +
                    "                                </form>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center\">\n" +
                    "                                <span class=\"text\" style=\"color: black; font-size: 22px\">Голосование</span>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center text\" style=\"font-size: 16px; color: #2f2f2f; margin: 10px 0\">\n" +
                    "                                Голосов за всё время: <span style=\"color: #01b828\">" + data[0].data.month_votes + "</span>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12\">\n" +
                    "                                <div class=\"row text-center\">\n" +
                    "                                    <div class=\"col-6\">\n" +
                        "                                    <a href=\"http://mcrate.su/project/9266\">\n"+
                        "                                        <img src=\"../images/mcrate.png\" alt=\"\"><br>\n"+
                        "                                    </a>\n" +
                    "                                    </div>\n" +
                    "                                    <div class=\"col-6\">\n" +
                    "                                        <a href=\"https://mctop.su/servers/6425/\">\n" +
                    "                                            <img src=\"https://mctop.su/media/projects/6425/tops.png\" alt=\"\">\n" +
                    "                                        </a>\n" +
                    "                                    </div>\n" +
                    "                                </div>\n" +
                    "                            </div>\n" +
                    "                            <div class=\"col-12 text-center mt-3\">\n" +
                    "                                <div class=\"row\">\n" +
                    "                                    <div class=\"col-6\"><button class=\"account_button4 account_text\" onclick='storage()'>Склад</button></div>\n" +
                    "                                    <div class=\"col-6\"><button class=\"account_button4 account_text\" onclick='Promo();'>Промокод</button></div>\n" +
                    "                                </div>\n" +
                    "                            </div>" +
                    "</div>").prependTo("#menu");
            }
        }
    });
}
function GetStatus(){
    $('#menu').empty();
    $("<!--                            Привилегии-->\n" +
        "                            <div class=\"col-12 text-center\">\n" +
        "                                <span class=\"text\" style=\"color: black; font-size: 20px\">Выберите привилегию</span>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12\" style=\"margin-top: 20px\">\n" +
        "                                <div class=\"row text-center justify-content-center\">\n" +
        "                                    <div class=\"col-4 nether_groups\" style=\"margin-bottom: 20px\" onclick=\"select_status(this)\" status=\"Dibbyk\">\n" +
        "                                        <img src=\"../images/account/dibbyk.png\" alt=\"\" width=\"120\"><br>\n" +
        "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 18px;\">Цена за месяц:  <s>50</s> 20 руб</div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-4 nether_groups\" style=\"margin-bottom: 20px\" onclick=\"select_status(this)\" status=\"Laraye\">\n" +
        "                                        <img src=\"../images/account/laraye.png\" alt=\"\" width=\"120\"><br>\n" +
        "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 18px;\">Цена за месяц: <s>120</s> 48 руб</div>\n" +
        "                                    </div>\n" +
        "                                    <div class=\"col-4 nether_groups\" style=\"margin-bottom: 20px\" onclick=\"select_status(this)\" status=\"Satana\">\n" +
        "                                        <img src=\"../images/account/satana.png\" alt=\"\" width=\"120\"><br>\n" +
        "                                        <div style=\"font-family: NetherCraft_Menu; font-size: 18px;\">Цена за месяц: <s>250</s> 96 руб</div>\n" +
        "                                    </div>\n" +
        "                                </div>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12 text-center\" style='margin-top: 20px; margin-bottom: 10px; font-family: NetherCraft_Menu; font-size: 16px;'>Выберите срок действия статуса</div>\n"+
        "                            <div class='col-12 text-center'>" +
        "                            <button class=\"orange-button\" onclick=\"NetherDonate.select_duration(this, '1');\" value=\"1\" id=\"selected_duration\">1 месяц</button>" +
        "                            <button class=\"orange-button\" onclick=\"NetherDonate.select_duration(this, '2');\" value=\"2\" id=\"selected_duration\">2 месяца</button>" +
        "                            <button class=\"orange-button\" onclick=\"NetherDonate.select_duration(this, '3');\" value=\"3\" id=\"selected_duration\">3 месяца</button>" +
        "                            </div>"+
        "                            <div class='col-12 text-center'><div id=\"group-price\"></div></div>\n"+
        "                            <div class=\"col-12 text-center\" style='margin: 10px 0'>\n" +
        "                                <button class=\"account_button2 account_text\" id='donate_buy' onclick=''>Купить</button>\n" +
        "                            </div>" +
        "                            <div class='col-12 text-center'><div id='group-duration'></div></div>").prependTo("#menu");
}
function GetSettings(){
    $("#menu").empty();
    $("<div class=\"col-12 text-center\">\n" +
        "                                <span class=\"text\" style=\"color: black; font-size: 22px\">Смена пароля</span>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12 text-center\">\n" +
        "                                <form id='password_change' action=\"\">\n" +
        "                                    <input type=\"text\" class=\"account-form\" id='future' name=\"future\" placeholder=\"Введите новый пароль\">\n" +
        "                                    <input type=\"text\" class=\"account-form\" id='future_r' name=\"future_r\" placeholder=\"Повторите новый пароль\">\n" +
        "                                    <input type=\"text\" class=\"account-form\" id='current' name=\"current\" placeholder=\"Введите старый пароль\"><br>\n" +
        "                                    <button type=\"submit\" class=\"account_button2 text\" style=\"font-size: 15px; margin-top: -5px\">Изменить</button>\n" +
        "                                </form>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12 text-center\" style=\"margin-top: 14px\">\n" +
        "                                <span class=\"text\" style=\"color: black; font-size: 22px\">Изменение почты</span>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12 text-center\">\n" +
        "                                <form id='email_change' action=\"\">\n" +
        "                                    <input type=\"text\" id='email' class=\"account-form\" name=\"balance\" placeholder=\"Введите E-mail\"><br>\n" +
        "                                    <button type=\"submit\" class=\"account_button3 text\" style=\"font-size: 15px; margin-top: -5px\">Изменить</button>\n" +
        "                                </form>\n" +
        "                            </div>" +
        "                            <div class=\"col-12 text-center\" style=\"margin-top: 14px\">\n" +
        "                                <span class=\"text\" style=\"color: black; font-size: 22px\">Привязка к Discord</span>\n" +
        "                            </div>\n" +
        "                            <div class=\"col-12 text-center\">\n" +
        "                                <button type=\"submit\" class=\"account_button4 text\" style=\"font-size: 15px; margin-top: 10px; margin-bottom: 5px\" onclick='Discord();'>Получить код</button>\n" +
        "                            </div>").prependTo("#menu");
}
function Promo(){
    $('#popup').remove();
    $('<div id="NetherPopupBackground" onclick="CloseExcaliburPopup();" style="display: block;"></div>\n' +
        '    <div id="NetherPopupWindow" style="display: block; left: 0; top: 0;">\n' +
        '        <div class="NetherPopupImg1"></div>\n' +
        '        <div class="NetherPopupContent">\n' +
        '            <div class="NetherPopupTitle">Активация промокода</div>\n' +
        "            <form id=\"promo\"> " +
        "               <label for='promocode'>Введите промокод:</label>" +
        "               <input type=\"text\" class=\"account-form\" name=\"promocode\" placeholder=\"Промокод\">\n" +
        "               <button type=\"submit\" class=\"account_button2 text\" style=\"font-size: 15px; margin-top: -5px\">Активировать</button>\n" +
        "            </form>\n" +
        '        </div>\n' +
        '        <div class="NetherPopupImg2"></div>\n' +
        '    </div>').prependTo($(".popup"));
    $("#NetherPopupWindow").css({
        'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
        'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
    });
}

function Discord(){
    $(document).ready(function(){
        $.ajax({
            type: 'POST',
            url: '/events.php',
            dataType: 'html',
            data: {
                action: "get_discord"
            },
            success: function (response) {
                var data = JSON.parse(response);
                if(data[0].status === "Success"){
                    $('#popup').remove();
                    $('<div id="NetherPopupBackground" onclick="CloseExcaliburPopup();" style="display: block;"></div>\n' +
                        '    <div id="NetherPopupWindow" style="display: block; left: 0; top: 0;">\n' +
                        '        <div class="NetherPopupImg1"></div>\n' +
                        '        <div class="NetherPopupContent">\n' +
                        '            <div class="NetherPopupTitle">Код Discord</div>\n' +
                        '            <input type=\"text\" class=\"account-form\" disabled="disabled" name=\"code\" value="'+ data[0].code +'"><br>\n' +
                        'Вставьте данный код в созданный ботом канал в нашем дискорд сервере.' +
                        '        </div>\n' +
                        '        <div class="NetherPopupImg2"></div>\n' +
                        '    </div>').prependTo($(".popup"));
                    $("#NetherPopupWindow").css({
                        'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
                        'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
                    });
                }
            },
            error: function(){
                console.log("Error");
            }
        });
    });
}

$(window).resize(function(){
    $("#NetherPopupWindow").css({
        'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
        'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
    });
});
function CloseExcaliburPopup() {
    $("#NetherPopupBackground").fadeOut(600);
    $("#NetherPopupWindow").fadeOut(600);
}
function CloseExcaliburPopupFast() {
    $("#NetherPopupBackground").fadeOut(0);
    $("#NetherPopupWindow").fadeOut(0);
}
