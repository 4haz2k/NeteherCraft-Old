$(document).ready(function () {
    var rendDelay;
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
                    render(false, delay)
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
        $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
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
        // console.log(skinURL); // ссылка на картинку во временной папке
        render(); // выполняет функцию рендра
    });
});
