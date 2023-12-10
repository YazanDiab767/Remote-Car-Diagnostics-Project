$(document).ready(function(){

    //To Delete Last Diagnose
    /*$.ajax({
        url: url("cars/rest_diagnose"),
        type: "POST",
        success: function(result)
        {
        }
    });*/

    if(typeof(EventSource) !== "undefined")
    {
      var source = new EventSource(url("cars/get_diagnosed"));
      source.onmessage = function(event)
      {
        $("#last_diagnose").html("");

        data = JSON.parse(event.data);
        let dig;
        if (data.last_diagnosed != "")
            dig = JSON.parse(data.last_diagnosed);
        else
            $("#last_diagnose").append("<td class = 'text-danger'> <b> There is no update </b> </td>");

        

        let length = Object.size(dig);
        
        if (length > 0)
        {
            for (let i = 0; i < length; i++)
            {
                let vals = dig[i].split("-");
                $("#last_diagnose").append(`
                    <tr>
                        <th style="width: 35%;"> ${ vals[0] } </th>
                        <td> ${ vals[1] } </td>
                    </tr>
                `); 
            }
        }
      };
    }
    else
    {
      alert("Not Found EventSource");
    }

    $("#rest").click(function(){
        $.ajax({
            url: url("cars/rest_diagnose"),
            type: "POST",
            success: function(result)
            {
                if (result == 1)
                    $("#last_diagnose").html("");
                else
                    alert(result);
            }
        });

    });
  
  });

