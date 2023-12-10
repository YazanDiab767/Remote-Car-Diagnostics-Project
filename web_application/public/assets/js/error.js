$(document).ready(function(){

    $(".btn_delete").on("click",function(e){
        e.preventDefault();

        $("#loading").show();

        let t = $(this);

        let id = t.attr("value");
        

        $.ajax({
            url: url("cars/delete_error/"),
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

    $("#btn_add_error").click(function(){

        $("#loading").show();

        let error_code = $("#error_code").val();
        let name_error = $("#name_error").val();

        let data = "error_code="+error_code+"&name_error="+name_error;

        $.ajax({
            url: url("cars/new_error/"),
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
