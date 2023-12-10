<html>
    <head>
        <?php 
            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "index"]);
        ?>
        <title> Drivers </title>
    </head>
    <body>

        <div class="container">
            <div class="box">
                <div class = "row">
                    <div class="center"> <h3> <i class="fas fa-users"></i> Drivers </h3> </div><br/>
                </div><br/>
                <div class = "row">
                    <div class="col-md-3 col-xs-12">
                        <a href="<?php echo url("main"); ?>" class="btn btn-info center"> Main <i class="fas fa-hand-point-left"></i> </a>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_new" data-whatever="@mdo"> Add New Driver <i class="fas fa-plus-square"></i> </button>
                    </div>
                </div>
                <div class="row">
                    
                </div>
                <hr>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th> # </th>
                            <th> Driver Name </th>
                            <th> Number Phone </th>
                            <th> Delete </th>
                        </tr>
                        <?php
                            for ($i = 0; $i < count($data); $i++)
                            {
                                
                                echo
                                '
                                    <tr class="tr">
                                        <td> '.($i + 1).' </td>
                                        <td> '.$data[$i]["name"].' </td>
                                        <td> '.$data[$i]["phone_number"].' </td>
                                        <td> <a href="#" class="btn_delete" value = "'.$data[$i]["driver_id"].'"> <i class = "fas fa-trash"></i> Delete  </a> </td>
                                    </tr>
                                ';
                            }
                        ?>
                    </table>
                <hr>


            </div>
        </div>


        <div class="modal fade" id="form_new" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Add New Driver </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="name" class="form-control" id = "driver_name" placeholder="Enter Full Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id = "phone_number" placeholder="Enter Phone Number" maxlength="15" required>
                            </div>
                            <div class="alert alert-danger error" id="error"  role="alert">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close <i class="fas fa-times"></i></button>
                        <button type="button" class="btn btn-primary" id = "btn_add_driver"> Add <i class="fas fa-plus"></i> </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="loading" class="loading">
            <center>
                <i class="fa fa-spinner fa-spin fa-6x fa-fw center" id="spinner_login" style="color: white; margin-top: 30px;"></i>
            </center>
        </div>
        
    
        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer();
            $inc->file(["type" => "js", "name" => "driver"]);
        ?>
    </body>
</html>