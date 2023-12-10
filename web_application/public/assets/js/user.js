$(document).ready(function(){

    $("#form_login").on('submit',function(e){
        e.preventDefault();

        let data = new FormData(this);
        $("#spinner_login").show();
        $("#result").hide();
        
       $.ajax({
            url: url("user/login"),
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function(result)
            {
                $("#result").html("");
                $("#result").show();
                $("#spinner_login").hide();

                if (result == 1)
                {
                    $("#result").append(`
                        <div class = "alert alert-success">
                            Welcome <i class="far fa-smile"></i>
                        </div>
                    `);
                    setTimeout(function(){
                        location.assign(url("main"));
                    },2500);
                    
                }
                else
                {
                    $("#result").append(`
                        <div class = "alert alert-danger">
                            <i class="fas fa-times"></i> Error Username Or Password 
                        </div>
                    `);
                }
            }
        });
    });


    $("#form_change_name").on('submit',function(e){
        e.preventDefault();

        let data = new FormData(this);
        $("#spinner_username").show();
        $("#result_username").hide();
        $.ajax({
                url: url("user/updateName"),
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result)
                {
                    $("#result_username").html("");
                    $("#result_username").show();

                    $("#spinner_username").hide();
                    if (result == 1)
                    {
                        $("#result_username").append(`
                        <div class = "alert alert-success">
                            Done <i class="fas fa-check-circle"></i>
                        </div>
                        `);
                        setTimeout(function(){
                            location.assign(url("user/settings"));
                        },2500);
                    }
                    else
                    {
                        $("#result_username").append(`
                            <div class = "alert alert-danger">
                                ${result}
                            </div>
                        `);
                    }
                }
            });
    });

    $("#form_change_password").on('submit',function(e){
        e.preventDefault();

        let data = new FormData(this);
        $("#spinner_pass").show();
        $("#result_password").hide();
        $.ajax({
                url: url("user/updatePass"),
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(result)
                {
                    $("#result_password").html("");
                    $("#result_password").show();
                    $("#spinner_pass").hide();
                    if (result == 1)
                    {
                        $("#result_password").append(`
                        <div class = "alert alert-success">
                            Done <i class="fas fa-check-circle"></i>
                        </div>
                        `);
                        setTimeout(function(){
                            location.assign(url("user/settings"));
                        },2500);
                        
                    }
                    else
                    {
                        $("#result_password").append(`
                            <div class = "alert alert-danger">
                                ${result}
                            </div>
                        `);
                    }
                }
            });
    });

});