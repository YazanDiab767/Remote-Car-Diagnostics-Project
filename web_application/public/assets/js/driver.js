$(document).ready(function(){

    $(".btn_delete").on("click",function(e){
        
        e.preventDefault();
        $("#loading").show();
        let t = $(this);

        let id = t.attr("value");
        

        $.ajax({
            url: url("driver/delete_driver/"),
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

    $("#btn_add_driver").click(function(){

        $("#loading").show();

        let driver_name = $("#driver_name").val();
        let phone_number = $("#phone_number").val();

        let data = "driver_name="+driver_name+"&phone_number="+phone_number;

        $.ajax({
            url: url("driver/add_driver"),
            type:"POST",
            data:data,
            success: function(result)
            {
                if (result == 1)
                {
                    $("#loading").hide();

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