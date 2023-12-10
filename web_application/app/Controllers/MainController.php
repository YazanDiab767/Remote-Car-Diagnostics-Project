<?php
    class MainController
    {



        public function index()
        {
            $user = new UserController();
            $user->checkLogin();
            
            View::load("main");
        }

    }
    
?>