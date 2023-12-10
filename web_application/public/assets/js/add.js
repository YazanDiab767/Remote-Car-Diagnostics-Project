$(document).ready(function(){
    
    $("#form_add_error").submit(function(e){

        e.preventDefault();
        
        let error_code = $("#error_code").val();
        let name_error = $("#name_error").val();

        let data = new FormData(this);
        
        $("#error").show();
        
        $.ajax({
            url: "",
            type: "POST",
            data: data,
            contentType: false,
            proscessData: false,
            success: function(data)
            {
                if (data == 1)
                {

                }
                else
                {
                    
                }
            }
        });


    });


});