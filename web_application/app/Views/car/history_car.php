<html>
    <head>
        <?php 
            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "cars"]);
        ?>
        <title> History Car </title>
    </head>
    <body>

        <div class="container">
            <div class="row box">
                <div class="col-md-2">
                    <br/>
                    <a href='<?php echo url("cars/view"); ?>'> <i class="fas fa-home"></i> Home  </a>
                </div>
                <div class="col-md-10">
                    <table class="table table-bordered">
                        <tr>
                            <td>  Car Number : <?php echo $car["car_id"]; ?> </td>
                            <td> Driver Name  : <?php echo $car["name"]; ?> </td>
                            <td>  Car Type : <?php echo $car["type"]; ?> </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th>  Data</th>
                            <th> Date </th>
                            <th> Time </th>
                        </tr>
                    </thead>
                    <tbody id = "data">
                        <?php

                            for ($i = 0; $i < count($errors); $i++)
                            {
                                $data_errors = json_decode($errors[$i]["errors"]);
                                echo
                                '
                                    <tr>
                                        <td class = "align-middle">'.($i+1).'</td>
                                        <td> <table class = "table table-striped text-center">';
                                            foreach($data_errors as $value)
                                            {
                                                $array_value = explode(":",$value);
                                                echo
                                                    "
                                                    <tr>
                                                        <td>". $array_value[0] . "</td>
                                                        <td>". $array_value[1] . "</td>
                                                    </tr>
                                                    "
                                                ;
                                            }
                                echo'</table> </td>
                                        <td class = "align-middle">'.$errors[$i]["dt"].'</td>
                                        <td class = "align-middle">'.$errors[$i]["time"].'</td>
                                    </tr>
                                ';
                            }
                        ?>

                    </tbody>
                </table>
                <div class="center">
                    <?php
                        if (count($errors) > 9)
                        {
                            echo '<a href="#" class = "text-primary" id = "show_more"> Show More <i class="fas fa-chevron-circle-down"></i> </a>';
                        }
                    ?>
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw" id="spinner" style="color: black; display: none; padding: 5px;"></i>
                </div>
            </div>
        </div>
    
        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer();
            $inc->file(["type" => "js", "name" => "cars"]);
        ?>
    </body>
</html>