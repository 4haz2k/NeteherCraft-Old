$(document).ready(function () {
    var rendDelay;

    $.ajax({
        type: 'POST',
        url: '/skinChecker.php',
        dataType: 'html',
        data: $(this).serialize(),
        success: function (response) {
            var data = JSON.parse(response);
            if(data[0].status === 'success') {
                skinURL = data[0].data.url;
                render();
            }
        }
    });

    $.ajax({
        type: 'POST',
        url: '/events.php',
        data: {
            action: "kit_load"
        },
        success: function (response) {
            var data = JSON.parse(response);
            if(data[0].status === 'Success') {
                $("#kits").html(data[0].data);
            }
        }
    });

    function checkImageSize(file){
        var img = file;
        var bool;
            // `naturalWidth`/`naturalHeight` aren't supported on <IE9. Fallback to normal width/height
            // The natural size is the actual image size regardless of rendering.
            // The 'normal' width/height are for the **rendered** size.
            var width, height;
            width  = img.naturalWidth  || img.width;
            height = img.naturalHeight || img.height;
            if(width == 64 && height == 64 || width == 64 && height == 32){
                return true;
            }
            else {
                return false;
            }
            // Do something with the width and height
    // Setting the source makes it start downloading and eventually call `onload`
    }
    function render(checkskin=true, delay=false){ //1 проход
        if(skinURL === undefined){ return; } // если ложный вызов, то отмена
        if (delay) {
            if (rendDelay) {window.clearTimeout(rendDelay);}
            rendDelay = window.setTimeout(render, 500);
        }
        else { //1 проход 2 проход
            if (checkskin) { //1 проход
                skinChecker(function(){
                    console.log('slimness: '+isSlim);
                    // $("#skintype-alex").prop("checked", isSlim);
                    // $("#skintype-steve").prop("checked", !isSlim);
                    render(false, delay);
                });
            }
            else { //2 проход
                if($('[id^=minerender-canvas-]')[0]){ // если canvas уже существует, то очистить его
                    skinRender.clearScene(); // очищение canvasa
                }
                // try {
                    skinRender.render({
                        url: skinURL,
                        slim: "false" /*isSlim*/
                    });
                // }
                // catch{
                //     var element = document.createElement("div");
                //     element.appendChild(document.createTextNode('Данный файл не скин'));
                //     document.getElementById('skinViewerContainer').appendChild(element);
                // }
            }
        }
    }
    $('#button').click(function(){
        $("input[type='file']").trigger('click');
    })

    $("input[type='file']").change(function(){
        $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''));
    })
    function skinChecker(callback){
        var image = new Image();
        image.crossOrigin = "Anonymous";
        image.src = skinURL;

        image.onload = function(){
            var detectCanvas = document.createElement("canvas");
            var detectCtx = detectCanvas.getContext("2d");
            detectCanvas.width = image.width;
            detectCanvas.height = image.height;
            detectCtx.drawImage(image, 0, 0);
            var px1 = detectCtx.getImageData(46, 52, 1, 12).data;
            var px2 = detectCtx.getImageData(54, 20, 1, 12).data;
            var allTransparent = true;
            for(var i = 3; i < 12 * 4; i += 4){
                if(px1[i] === 255){
                    allTransparent = false;
                    break;
                }
                if (px2[i] === 255) {
                    allTransparent = false;
                    break;
                }
            }
            isSlim = allTransparent;
            if(callback !== undefined){ callback(); }
        }
    }
    var skinRender = new SkinRender({
        autoResize : true,
        controls : {
            enabled : false,
            zoom : false,
            rotate : false,
            pan : false
        },
        canvas : {
            height : 250,//$("#skinViewerContainer")[0].offsetHeight,
            width : 150//$("#skinViewerContainer")[0].offsetWidth
        },
        camera : {
            x : 15,
            y : 25,
            z : 24,
            target: [0, 17, 0]
        }
    }, $("#skinViewerContainer")[0]);
    var startTime = Date.now();
    var t;
    $("#skinViewerContainer").on("skinRender", function(e){
        if(!e.detail.playerModel){ return; }
        e.detail.playerModel.rotation.y += 0.01;
        t = (Date.now() - startTime) / 1000;
        e.detail.playerModel.children[2].rotation.x = Math.sin(t * 5) / 2;
        e.detail.playerModel.children[3].rotation.x = -Math.sin(t * 5) / 2;
        e.detail.playerModel.children[4].rotation.x = Math.sin(t * 5) / 2;
        e.detail.playerModel.children[5].rotation.x = -Math.sin(t * 5) / 2;
    });
    $("#input-file").on("change", function(event){
        if($("#input-file")[0].files.length === 0){ return; }
        skinURL = URL.createObjectURL(event.target.files[0]); // передаем переменной ссылку на картинку
        //console.log(skinURL); // ссылка на картинку во временной папке
        render(); // выполняет функцию рендра
    });

    $('body').on("submit", "#trade_tokens", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'trade_tokens',
                amount: $('#trade_tokens').children('input').val()
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].message != null) {
                    if ($("#nether_info_block").css('display') == 'none'){ $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html(); GetMain();}
                    else {$("#nether_info_block").html(result[0].message); GetMain();}
                }
            }
        });
    });

    $('body').on("submit", "#password_change", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'change_password',
                future: $('#future').val(),
                future_r: $('#future_r').val(),
                current: $('#current').val()
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].message != null) {
                    if ($("#nether_info_block").css('display') == 'none'){ $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();}
                    else {$("#nether_info_block").html(result[0].message);}
                }

            }
        });
    });

    $('body').on("submit", "#email_change", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'change_email',
                email: $('#email').val(),
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].message != null) {
                    if ($("#nether_info_block").css('display') == 'none'){ $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();}
                    else {$("#nether_info_block").html(result[0].message);}
                }

            }
        });
    });

    $('body').on("submit", "#pay", function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: {
                action: 'create_payment',
                money: $('#pay').children('input').val()
            },
            success: function (resp) {
                var result = JSON.parse(resp);

                if (result[0].status === "Fail") {
                    if ($("#nether_info_block").css('display') == 'none'){ $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html(); GetMain();}
                    else {$("#nether_info_block").html(result[0].message); GetMain();}
                }

                if (result[0].status === "Success") {
                    var payment = new UnitPay();
                    payment.createWidget({
                        publicKey: "402233-cec65",
                        sum: result[0].data.sum,
                        account: result[0].data.account,
                        domainName: "unitpay.money",
                        signature: result[0].data.signature,
                        desc: "Пополнение баланса NetherCraft",
                        locale: "ru",
                        currency: "RUB"
                    });
                    payment.success(function (params) {
                    });
                    payment.error(function (message, params) {
                        console.log(message);
                    });
                    return false;
                }
            }
        });
    });

    $('#button_upload').click(function(e){
        var file = $("#input-file").val();
        if(file != ""){
            e.preventDefault();
            var data = new FormData;
            data.append( 'userfile', document.getElementById('input-file').files[0]);
            $.ajax({
                type: 'POST',
                url: '/events_file.php',
                data: data,
                processData: false,
                cache : false,
                contentType: false,
                success: function (resp) {
                    var result = JSON.parse(resp);
                    if (result[0].status === "Success") {
                        if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                        else $("#nether_info_block").html(result[0].message);
                    }
                }
            });
        }
        else{
            if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html("Сначала необходимо выбрать файл!").fadeIn(600).delay(800).fadeOut(600).html();
            else $("#nether_info_block").html(result[0].message);
        }
    });
});

function PayBlock(money){
    $.ajax({
        type: 'POST',
        url: '/events.php',
        data: {
            action: 'create_payment',
            money: money
        },
        success: function (resp) {
            var result = JSON.parse(resp);

            if (result[0].status === "Fail") {
                if ($("#nether_info_block").css('display') == 'none'){ $("#nether_info_block").html(result[0].message).fadeIn(600).delay(800).fadeOut(600).html(); GetMain();}
                else {$("#nether_info_block").html(result[0].message); GetMain();}
            }

            if (result[0].status === "Success") {
                var payment = new UnitPay();
                payment.createWidget({
                    publicKey: "402233-cec65",
                    sum: result[0].data.sum,
                    account: result[0].data.account,
                    domainName: "unitpay.money",
                    signature: result[0].data.signature,
                    desc: "Пополнение баланса NetherCraft",
                    locale: "ru",
                    currency: "RUB"
                });
                payment.success(function (params) {
                });
                payment.error(function (message, params) {
                    console.log(message);
                });
                return false;
            }
        }
    });
}


