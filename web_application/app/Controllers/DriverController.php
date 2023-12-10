<?php

if(!isset($_SESSION)) 
{ 
    //session_start(); 
} 

    class DriverController
    {

        public function get_drivers()
        {
            $d = new Driver();

            return $d->get_all_drivers();

        }

        public function add_driver()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $d = new Driver();
                $data = array(
                    "name" => filter_var($_POST['driver_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    "phone_number" =>filter_var($_POST['phone_number'],FILTER_SANITIZE_FULL_SPECIAL_CHARS)
                );
                if ($d->new_driver($data))
                    echo 1;
                else
                    echo " Error Add ";
            }
        }

        public function delete_driver()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $c = new Driver();
                extract($_POST);
                if ($c->delete_driver($id))
                {
                    echo 1;
                }
                else
                {
                    echo "Problem In Delete";
                }

    
            }            
        }

    }

?>