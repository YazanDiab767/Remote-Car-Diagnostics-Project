

<html>
    <head>
        <?php 
            
            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "index"]);
        ?>
        <title> Settings </title>
    </head>
    <body>

        <div class="container">
            <div class="box">
                <div class = "row">
                    <div class="center"> <h3> <i class="fas fa-user-cog"></i> Settings </h3> </div><br/>
                </div><br/>
                <div class = "row">
                    <div class="col-md-3 col-xs-12">
                        <a href="<?php echo url("main"); ?>" class="btn btn-info center"> Main <i class="fas fa-hand-point-left"></i> </a>
                    </div>
                    <div class="col-md-3 col-xs-12">
                    </div>
                </div>
                <hr>

                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#username">Username</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#password">Password</a>
                    </li>
                </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="username" class="container tab-pane active"><br>
                    <form method="POST" class="form-signin" id="form_change_name">
                        <div class="form-label-group">
                            <input type="text" id="input_username" name="input_username" class="form-control" placeholder="Enter New Username" required>
                        </div>
                        <br/>
                        <div class="form-label-group">
                            <input type="password" id="input_password" name="input_password" class="form-control" placeholder="Enter Password" required>
                        </div>
                        <br/>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button>
                        <br/>
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw center" id="spinner_username" style = "display: none;"></i>
                        </div>
                        <div id="result_username">

                        </div>
                    </form>
                </div>
                <div id="password" class="container tab-pane fade"><br>
                    <form method="POST" class="form-signin" id="form_change_password">
                        <div class="form-label-group">
                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter Old Password" required>
                        </div>
                        <br/>
                        <div class="form-label-group">
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter New Password" required>
                        </div>
                        <br/>
                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save</button>
                        <br/>
                        <div class="text-center">
                            <i class="fa fa-spinner fa-spin fa-3x fa-fw center" id="spinner_pass" style = "display: none;"></i>
                        </div>
                        <div id="result_password">

                        </div>
                    </form>
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
            $inc->file(["type" => "js", "name" => "user"]);
        ?>
    </body>
</html>
