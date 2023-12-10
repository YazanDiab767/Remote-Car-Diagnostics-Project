<html>
    <head>
        <?php 
            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "index"]);
        ?>
        <title> الرئيسية </title>
    </head>
    
    <body style="background-image: url(<?php echo url('assets/images/car2.jpg'); ?>); background-color: #1a1a1a; background-repeat: no-repeat; background-position: center; background-size: 80%;">
        <div class="container">
            <div class="box" style="width: 50%;">
                <div class = "row" >
                    <div class="center"> <h2> Main </h2> </div>
                </div>
                <ul class="list-group center list" style="width: 100%;">
                    <li class="list-group-item"> <a href="<?php echo url('cars'); ?>">  Live Data <i class="fas fa-eye"></i> </a> </li>
                    <li class="list-group-item"> <a href="<?php echo url('view/driver'); ?>"> Drivers  <i class="fas fa-address-card"></i> </a> </li>
                    <!--<li class="list-group-item"> <a href="<?php echo url('view/error'); ?>"> Errors <i class="fas fa-times"></i> </a> </li>-->
                    <li class="list-group-item"> <a href="<?php echo url('view/car'); ?>"> Cars <i class="fas fa-car"></i> </a> </li>
                    <li class="list-group-item"> <a href="<?php echo url('user/settings'); ?>"> Settings <i class="fas fa-user-cog"></i> </a> </li>
                    <li class="list-group-item"> <a href="<?php echo url('user/logout'); ?>"> Logout <i class="fas fa-sign-in-alt"></i> </a> </li>
                </ul>
            </div>
        </div>
    
        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer();  
        ?>
    </body>
</html>