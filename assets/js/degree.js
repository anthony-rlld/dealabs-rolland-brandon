$(document).ready(function (){

    $("#degreePlus").on('click',function (){

       $.ajax({
            url: Routing.generate("app_degree",{ id: $(this).attr("data-id"), degree: 1 }),
            success: function (response){
                $("#valDegree").text(response+"°");
            }
       });
    });

    $("#degreeMoins").on('click',function (){

        $.ajax({
            url: Routing.generate("app_degree",{ id: $(this).attr("data-id"), degree: -1 }),
            success: function (response){
                $("#valDegree").text(response+"°");
            }
        });
    });

});