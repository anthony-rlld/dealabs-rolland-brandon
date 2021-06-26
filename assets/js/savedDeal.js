$(document).ready(function (){

    $(".saveDeal").on('click',function (){

        $.ajax({
            url: Routing.generate("app_saveDeal",{ id: $(this).attr("data-id") }),
            success: function (response){
                $("#saveDeal" + response.id).addClass('bg-primary text-white');
            }
        });
    });

});