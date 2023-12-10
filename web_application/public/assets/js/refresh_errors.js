$(document).ready(function(){


  if(typeof(EventSource) !== "undefined")
  {
    var source = new EventSource(url("cars/get_errors"));
    source.onmessage = function(event)
    {
      data = JSON.parse(event.data);
      for (let i = 0; i < data.length; i++)
      {
        if (Object.size(data[i]) > 1)
        {
          $("#car_"+data[i]["car_id"]).html("");

          let errors = JSON.parse(data[i].data["errors"]);
          for (let j = 0; j < Object.size(errors); j++)
          {
            let part_error = errors[j].split(":");
            //$("#car_"+data[i]["car_id"]).append(errors[j] + "<br />");
            $("#car_"+data[i]["car_id"]).append(`
            <tr>
              <td style = "color: green;">${part_error[0]}</td>
              <td style = "color: red;">${part_error[1]}</td>
            </tr>
            `);
          }
          $("#car_"+data[i]["car_id"]).append(`<br/><div class = "text-center"><label class = "text-info"> <i class="fas fa-clock"></i> ${data[i]["data"]["time"]}</label></div>`);
          
        }
        else
        {
          $("#car_"+data[i]["car_id"]).html("There's No Error <br />");
        }
        
      }
    };
  }
  else
  {
    alert("Not Found EventSource");
  }

  //Get Id Car And Send To Button (check up)
  $(".conformation_check_up").click(function(){
    let id = $(this).attr("value");
    $("#btn_check_up").attr("href",url('cars/checkUp/'+id))
  });

  $("#btn_check_up").click(function(){

  });
  

});