$(document).ready(function (){

    $("#degreePlus").on('click',function (){

       $.ajax({
            url: Routing.generate("app_degree"),
            data: {
                id : $(this).attr("data-id"),
                degree: 1
            },
            success: function (){
                alert("sheeeeeeeeeeeeeeeesh");
            }
       });
    });

    $("#degreeMoins").on('click',function (){

        var url = Routing.generate("app_degree");
        $.ajax({
            url: url,
            data: {
                id : $(this).attr("data-id"),
                degree: -1
            },
            success: function (){
                alert("sheeeeeeeeeeeeeeeesh");
            }
        });
    });

});