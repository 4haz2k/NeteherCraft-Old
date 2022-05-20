$(document).ready(function () {

    $('#items').on("submit",function (e) {
        e.preventDefault();
        var fd = new FormData;
        fd.append('img', document.getElementById('inputGroupFile01').files[0]);
        fd.append('title', $("#title").val());
        fd.append('price', $("#price").val());
        fd.append('category', $("#inputGroupSelect02").val());
        fd.append('item_meta', $("#item_meta").val());
        fd.append('action', "items_upload");
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                var data = JSON.parse(response);
                if(data[0].message === "Success") {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                    console.log(data);
                    document.getElementById('item_meta').value = "";
                    document.getElementById('title').value = "";
                    document.getElementById('price').value = "";
                    document.getElementById('inputGroupSelect02').value = "";
                    document.getElementById('inputGroupFile01').value = "";
                }
                else{
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                }

            },
        });
    });

    $('#kits').on("submit",function (e) {
        e.preventDefault();
        var fd = new FormData;
        fd.append('img', document.getElementById('inputGroupFile011').files[0]);
        fd.append('description', $("#description1").val());
        fd.append('title', $("#title1").val());
        fd.append('price', $("#price1").val());
        fd.append('votes', $("#votes1").val());
        fd.append('items', $("#items1").val());
        fd.append('type', $("#type1").val());
        fd.append('command', $("#command1").val());
        fd.append('action', "kit_upload");
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                if(data[0].message === "Success") {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                    console.log(data);
                    document.getElementById('img1').value = "";
                    document.getElementById('description1').value = "";
                    document.getElementById('price1').value = "";
                    document.getElementById('votes1').value = "";
                    document.getElementById('items1').value = "";
                    document.getElementById('inputGroupFile011').value = "";
                }
                else{
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                }

            },
        });
    });

    $('#news').on("submit",function (e) {
        e.preventDefault();
        var fd = new FormData;
        fd.append('img', document.getElementById('inputGroupFile012').files[0]);
        fd.append('description', $("#description3").val());
        fd.append('title', $("#title3").val());
        fd.append('action', "news_upload");
        $.ajax({
            type: 'POST',
            url: '/events.php',
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                if(data[0].message === "Success") {
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                    console.log(data);
                    document.getElementById('title3').value = "";
                    document.getElementById('description3').value = "";
                    document.getElementById('inputGroupFile012').value = "";
                }
                else{
                    if ($("#nether_info_block").css('display') == 'none') $("#nether_info_block").html(data[0].message).fadeIn(600).delay(800).fadeOut(600).html();
                    else $("#nether_info_block").html(data[0].message);
                }

            },
        });
    });
})