<html>
    <head>
         <?php 

            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "cars"]);
         ?>
        <title> Cars  </title>
    </head>
    <body style="background-image: url(<?php echo url('assets/images/car1.jpg'); ?>); background-repeat: no-repeat; background-position: center; background-size: 100%;">

         <?php

            //$myfile = fopen("check_up.txt", "w");
       

            $myfile = fopen("check_up.txt", "w");
            $txt = "0";
            fwrite($myfile, $txt);
            fclose($myfile);

         ?>

        <nav class="navbar navbar-expand-sm navbar-light" style = "background-color: rgba(0,0,0,0.5);"> 
            <div class="container">

                <a class="navbar-brand" style = "color: white;" href="#"> 
                    <i class="fas fa-satellite-dish"></i> Live Data 
                    <a href="<?php echo url("main"); ?>" class="btn btn-info" style="margin-left:20px;"><i class="fas fa-home"></i>  Main  </a>
                </a>   
            </div> 
        </nav>
        <br/>
        
        <div class="container mt-4">
            <div class="row">
                <?php
                    for ($i = 0; $i < count($data);$i++)
                    {
                        echo
                        '  
                            <div class="col-auto mb-3">
                                <div class="card" style="width: 30rem; border: 1.2px solid black;">
                                    <div class="card-body">
                                        <h6 class="card-title">  <i class="fas fa-user"></i> Driver Name : '.$data[$i]["name"]. '</label> </h6>
                                        <h6 class="card-subtitle mb-2 text-muted"><i class="fas fa-car"></i> Car Number : ' . $data[$i]["car_id"] .'</h6><hr>
                                        <p class="card-text">
                                            <center>
                                                <table  class="table table-bordered" style="border: 3px black" id=car_'.$data[$i]["car_id"].'>
                                                    <!--<i class="fa fa-spinner fa-w-16 fa-spin fa-lg center"></i>-->
                                                    
                                                </table>
                                            </center>
                                        </p>
                                        <hr>
                                        <a href="'.url("cars/history/".$data[$i]["car_id"]).'" class = "card-link text-primary"><i class="fas fa-table"></i> History</a>
                                        <a href="#"  value="'.$data[$i]["car_id"].'" data-toggle="modal" data-target="#confirmation" class = "card-link text-primary conformation_check_up"><i class="fas fa-check-double"></i> Check Up</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>

        <div class="modal fade" id="confirmation" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label"> Check ... </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                    Check if car engine off  and switch on.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-primary" id="btn_check_up" value="">Go</a>
                </div>
                </div>
            </div>
        </div>

        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer();
            $inc->file(["type" => "js", "name" => "refresh_errors"]);
            
        ?>
    </body>
</html>