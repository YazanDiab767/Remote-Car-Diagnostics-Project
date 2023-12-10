<?php
    class ViewController
    {

        
        public function driver()
        {
            $user = new UserController();
            $user->checkLogin();

            $c = new DriverController();
            $data = $c->get_drivers();
            View::load("/view/driver",array("data" => $data));
        }

        public function car()
        {
            $user = new UserController();
            $user->checkLogin();

            $c = new CarsController();
            $d = new DriverController();
            $data = $c->get_cars();
            $drivers = $d->get_drivers();
            View::load("/view/car",array("data" => $data,"drivers" => $drivers));
        } 

        public function error()
        {
            $user = new UserController();
            $user->checkLogin();
            
            $c = new CarsController();
            $data = $c->get_data_errors();
            View::load("/view/error",array("data" => $data));
        } 


    }
    
?>