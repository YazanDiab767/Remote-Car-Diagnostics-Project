<html>
    <head>
        <?php 

            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "cars"]);
        ?>
        <title> Check Up  </title>
    </head>
    <body>

        <?php


            if (!isset($_SESSION))
                session_start();

            $_SESSION['check_up_car_id'] = $car["car_id"];
            
    

            //Set Check Up Equal True ( 1 ) To Make API ( addError ) To Get Diagnose Car Rather Get Errors

            $myfile = fopen("check_up.txt", "w");
            $txt = "1";
            fwrite($myfile, $txt);
            fclose($myfile);

        ?>

        <nav class="navbar navbar-expand-sm navbar-light bg-white"> 
            <div class="container">
                <a class="navbar-brand text-success" href="#"> 
                    <i class="fas fa-car"></i> Form Check Up Car 
                    <a href="<?php echo url("cars"); ?>" class="btn btn-info" style="margin-left:20px;"><i class="fas fa-car"></i>  Cars  </a>
                </a>   
            </div> 
        </nav>
        <br/>

        <div class="row box">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr>
                        <td>  Car Number : <?php echo $car["car_id"]; ?> </td>
                        <td> Driver Name  : <?php echo $car["name"]; ?> </td>
                        <td>  Car Type : <?php echo $car["type"]; ?> </td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <thead class="thead-dark">
                <tr>
                <th scope="col"> Error Code </th>
                <th scope="col"> Value </th>
                </tr>
            </thead>
            <tbody id = "last_diagnose">
            </tbody>
        </table>

        <center>
            <button class="btn btn-info" id="rest"> <i class="fas fa-undo-alt"></i> Clear  </button>
        </center>

        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer();
            $inc->file(["type" => "js", "name" => "check_up"]);
        ?>
    </body>
</html>