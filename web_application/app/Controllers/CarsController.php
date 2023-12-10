<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    class CarsController
    {
        
        public function index()
        {
            $this->view();
        }

        public function view()
        {
            $user = new UserController();
            $user->checkLogin();

            $cars = $this->get_cars();
            return   View::load("car/view_cars",array("data" => $cars));

        }

        public function history($id)
        {
            $user = new UserController();
            $user->checkLogin();

            $_SESSION['car_id'] = $id;
            $car = $this->get_data_car($id);
            $errors = $this->get_history_errors($id);
            View::load("car/history_car",array("car" => $car[0],"errors" => $errors));
        }

        public function checkUp($id)
        {
            $user = new UserController();
            $user->checkLogin();
            
            $_SESSION['car_id'] = $id;
            $car = $this->get_data_car($id);
            View::load("car/check_up",array("car" => $car[0])); 
        }

        public function get_cars()
        {
            $c = new Car();
            return $c->get_all_cars();
        }

        public function get_errors()
        {
            header("Cache-Control: no-cache");
            header("Content-Type: text/event-stream");
            
            $c = new Car();
            $data = $c->get_all_last_update();

            echo "data:".json_encode($data)."\n\n";
            echo PHP_EOL;
            //ob_flush();
            flush();
        }

        public function get_data_car($car_id)
        {
            $c = new Car();
            return $c->get_all_cars($car_id);
        }

        public function get_history_errors($car_id)
        {
            $c = new Car();
            return $c->get_history($car_id);
        }

        public function get_history_errors_json()
        {
            if ($_SERVER['REQUEST_METHOD'] == "GET")
            {
                
                $c = new Car();
                echo json_encode($c->get_history($_SESSION['car_id'],$_GET['limit']));  
            }

        }

        public function new_error_car($data)
        {
            $c = new Car();

            $errors = json_encode($data["errors"],JSON_FORCE_OBJECT);
            $car_id = filter_var($data["car_id"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data = array(
                "errors" => $errors,
                "car_id" => $car_id
            );

            if ($c->new_error_car($data))
                return 1;
            else
                return 0;
            
        }

        public function get_all_cars()
        {
            $c = new Car();
            return $c->get_cars();
        }

        public function get_data_errors()
        {
            $c = new Car();
            $data = $c->get_errors();
            return $data;
        }

        public function delete_error()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $c = new Car();
                extract($_POST);
                if ($c->delete_error("$id"))
                {
                    echo 1;
                }
                else
                {
                    echo "Problem In Delete";
                }

    
            }

        }

        public function new_error()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $c = new Car();

                $error_id = filter_var($_POST["error_code"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $name = filter_var($_POST["name_error"],FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

                $data = array(
                    "error_id" => $error_id,
                    "name" => $name
                );

                if ($c->new_error($data))
                    echo 1;
                else
                    echo "The Error Has Already Exist";

            }
        }

        public function add_car()
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                $car_number = filter_var($_POST['car_number'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $car_type = filter_var($_POST['car_type'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $driver_id = filter_var($_POST['driver_id'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $data = array(
                    "car_id" => $car_number,
                    "type" => $car_type,
                    "driver_id" => $driver_id
                );
                
                $c = new Car();

                if ($c->new_car($data))
                    echo 1;
                else
                    echo "car number has already exist";

            }
        }

        public function delete_car()
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                $c = new Car();
                extract($_POST);
                if ($c->delete_car("$id"))
                {
                    echo 1;
                }
                else
                {
                    echo "Problem In Delete";
                }

    
            }               
        }

        //Update Diagnose To Car
        public function add_diagnosed($data)
        {
            $c = new Car();

            $values = json_encode($data["values"],JSON_FORCE_OBJECT);
            $car_id = filter_var($data["car_id"],FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if (strstr($values,'\n') || strstr($values,'\r'))
            {
                $values = str_replace('\n',"",$values);
                $values = str_replace('\r',"",$values);
            }

            $data = array(
                "last_diagnosed" => $values,
                "car_id" => $car_id
            );

            if ($c->new_diagnosed($data))
                return 1;
            else
                return 0;
        }
        
        //Get Diagnose By Car ID
        public function get_diagnosed()
        {
            header("Cache-Control: no-cache");
            header("Content-Type: text/event-stream");
            //session_start(); 
            $c = new Car();
            
            $data = $c->get_last_diagnosed($_SESSION['check_up_car_id']);
            //$data = $c->get_last_diagnosed("982357");


            //echo "data:".json_encode($data[0])."\n\n";
            echo "data:".json_encode($data[0])."\n\n";
            echo PHP_EOL;
            //ob_flush();
            flush();
        }

        //Rest Diagnose To Car
        public function rest_diagnose()
        {
            $c = new Car();
            
            if ($c->delete_diagnosed($_SESSION['check_up_car_id']))
            {
                $file = fopen("check_up.txt","w");
                $txt = "1,1";
                fwrite($file,$txt);
                fclose($file);
                
                echo 1;
            }
            else
            {
                echo "Error Delete";
            }
        }

        public function get_status($car_id)
        {
            $c = new Car();
            return $c->get_status($car_id);
        }

        public function new_status($data)
        {
            $c = new Car();
            return $c->set_status($data);
        }

        public function showData()
        {
            echo "Success";
        }
        
        public function get_last_history($car_id)
        {
            $c = new Car();
            return $c->get_last_history($car_id);
        }


    }
    
?>