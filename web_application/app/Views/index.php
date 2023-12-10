<html>
    <head>
        <?php 
            require_once(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
            $inc->file(["type" => "css", "name" => "index"]);
        ?>
        <title> Login </title>
    </head>

    <body style="background-color: #f8f9fa; background-repeat: no-repeat; background-position: center; background-size: 80%;">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5" style="box-shadow: 2px 3px 15px 7px black;">
                        <div class="card-body">
                            <h5 class="card-title text-center">Sign In</h5>
                            <form method="POST" class="form-signin" id="form_login">
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter Username" required>
                                </div>
                                <br/>
                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" required>
                                </div>
                                <br/>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                                <br/>
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw center" id="spinner_login" style = "display: none;"></i>
                                </div>
                                <div id="result">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
        <!-- Include Files Java Script  -->
        <?php 
            $inc->footer(); 
            $inc->file(["type" => "js", "name" => "user"]); 
        ?>
    </body>
</html>