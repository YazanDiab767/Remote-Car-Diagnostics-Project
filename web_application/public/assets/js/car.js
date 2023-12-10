$(document).ready(function(){

    $(".btn_delete").on("click",function(e){
        
        e.preventDefault();
        $("#loading").show();
        let t = $(this);

        let id = t.attr("value");
        

        $.ajax({
            url: url("cars/delete_car/"),
            type:"POST",
            data:"id="+id,
            success: function(result)
            {
                $("#loading").hide();
                if (result == 1)
                    t.closest(".tr").remove();
                else
                    alert("Error");
            }
        });

    });

    $("#btn_add_car").click(function(){

        $("#loading").show();

        let car_number = $("#car_number").val();
        let car_type = $("#car_type").val();
        let driver_id = $("#driver_id").val();

        let data = "car_number="+car_number+"&car_type="+car_type+"&driver_id="+driver_id;

        $.ajax({
            url: url("cars/add_car"),
            type:"POST",
            data:data,
            success: function(result)
            {
                if (result == 1)
                {
                    location.reload();
                }
                else
                {
                    $("#loading").hide();

                    $("#error").show();
                    $("#error").html(result);
                }
            }
        });

    });


});