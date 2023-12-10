<html>
    <head>
        <?php
            require(INC . 'Include.php');

            $inc = new Includs();
            $inc->head();
        ?>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>
                            Oops!</h1>
                        <h2>
                            404 Not Found</h2>
                        <div class="error-details">
                            Sorry, an error has occured, Requested page not found!
                        </div>
                        <div class="error-actions">
                            <a href="<?php echo url('index'); ?>" class="btn btn-primary btn-lg">
                                Take Me Home <i class="fas fa-home"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Include Files Java Script  -->
        <?php
            $inc->footer();
            //$inc->file(["type" => "js", "name" => "index"]);
        ?>
    </body>
</html>