$(document).ready(function () {
    $('#autorize').on("submit",function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'autorize.php',
            dataType: 'html',
            data: $(this).serialize(),
            success: function (response) {
                var data = JSON.parse(response);
                if(data[0].status === 'success'){
                    window.location.href = data[0].data.redirect;
                }
                else{
                    $('#popup').remove();
                    $('<div id="NetherPopupBackground" onclick="CloseExcaliburPopup();" style="display: block;"></div>\n' +
                        '    <div id="NetherPopupWindow" style="display: block; left: 0; top: 0;">\n' +
                        '        <div class="NetherPopupImg1"></div>\n' +
                        '        <div class="NetherPopupContent">\n' +
                        '            <div class="NetherPopupTitle">Ошибка авторизации</div>\n' +
                                     data[0].message +
                        '        </div>\n' +
                        '        <div class="NetherPopupImg2"></div>\n' +
                        '    </div>').prependTo($(".popup"));
                    $("#NetherPopupWindow").css({
                        'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
                        'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
                    });
                    document.getElementById('login_password').value = "";
                }

            },
            error: function () {
                $('#popup').remove();
                $('<div id="NetherPopupBackground" onclick="CloseExcaliburPopup();" style="display: block;"></div>\n' +
                    '    <div id="NetherPopupWindow" style="display: block; left: 0; top: 0;">\n' +
                    '        <div class="NetherPopupImg1"></div>\n' +
                    '        <div class="NetherPopupContent">\n' +
                    '            <div class="NetherPopupTitle">Непредвиденная ошибка</div>\n' +
                    'Проверьте, не используете ли Вы VPN, капча не дает вам войти в систему, если ошибка повторяется, обратитесь к <b>Администрации</b>.'+
                    '        </div>\n' +
                    '        <div class="NetherPopupImg2"></div>\n' +
                    '    </div>').prependTo($(".popup"));
                $("#NetherPopupWindow").css({
                    'left' : ($(window).width() - $("#NetherPopupWindow").width()) / 2,
                    'top' : ($(window).height() - $("#NetherPopupWindow").height()) / 2,
                });
            }
        });
    });

});
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