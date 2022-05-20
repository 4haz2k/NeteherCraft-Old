function feedbackAjax(){

    var data = new FormData($("#getskin")[0]);

    $.ajax({
        url : 'dataget.php',
        type : 'POST',
        processData: false,
        contentType: false,
        cache:false,
        data : data,
        success : function (response){
            $('#result_form').html(response);
        }
    });
}
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
                    $('#alert').remove();
                    $("<div class=\"alert alert-danger text-center\" role=\"alert\" id=\"alert\">" + data[0].message + "</div>").prependTo($(".modal-body"));
                    $('#alert').effect("shake", {direction: 'up', distance: '2'});
                }

            },
            error: function () {
                $('#alert').remove();
                $("<div class=\"alert alert-danger text-center\" role=\"alert\" id=\"alert\">Неизвестная ошибка, повторите позже</div>").prependTo($(".modal-body"));
                $('#alert').effect("shake", {direction: 'up', distance: '2'});
            }
        });
    });


// $("#autorize").on("submit", function() {
//     $.ajax({
//         type: "POST",
//         url: "minecraft/autorize.php",
//         dataType: 'html',
//         data: $(this).serialize(),
//         success: function (data) {
//             $('#message').html(data);
//          },
//         error: function () {
//             alert('error!');
//         }
//     });
// });
});