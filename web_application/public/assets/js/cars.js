$(document).ready(function(){
    
    let f = 10;
    let l = 10;
    let c = 11;

    //Show More Errors Car ...
    $("#show_more").click(function(e){
        e.preventDefault();
        let limit = f + "," + l;
        $("#show_more").hide();
        $("#spinner").show();
        $.ajax({
            url: url("cars/get_history_errors_json/?limit="+limit),
            type:"GET",
            proscessData: false,
            contentType: false,
            success: function(result)
            {
                $("#spinner").hide();
                f += 10;
                let errors = JSON.parse(result);

                for (let i = 0; i < errors.length; i++)
                {
                    let data_errors = JSON.parse(errors[i]["errors"]);
                    
                    let data_error = "";
                    let errors_table = "";
                    //Combines all errors in one variable
                    for (let j = 0; j < Object.size(data_errors);j++)
                    {
                        let errors_array = data_errors[j].split(":");
                        errors_table += (`
                            <tr>
                                <td> ${errors_array[0]} </td>
                                <td> ${errors_array[1]} </td>
                            </tr>`);
                    }

                    $("#data").append(`
                        <tr>
                            <td class = "align-middle">${c}</td>
                            <td>
                                <table class = "table table-striped">
                                   ${errors_table} 
                                </table>
                            </td>
                            <td class = "align-middle">${errors[i]["dt"]}</td>
                            <td class = "align-middle">${errors[i]["time"]}</td>
                        </tr>
                    `);
                    c++;
                }
                $("html, body").animate({ scrollTop: $(document).height() }, 1000);

                if (errors.length > 9)
                {
                    $("#show_more").show();
                }
            }

        });
    });

});