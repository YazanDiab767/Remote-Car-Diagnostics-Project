<?php
    if(!isset($_SESSION)) 
    { 
        //session_start(); 
    } 

    class ExternalController
    {
        

        
        public function addError()
        {
            //symbol error (get on request) and range and name
            /*$errors = array(
                "value1" => array(
                    "range" => "0-0.1",
                    "name" => "high column tempreture"
                ),
                "value2" => array(
                    "range" => "0-0.1",
                    "name" => "error in battery"
                )
            );*/

            if (isset($_GET['car_id']))
            {
                $car = new CarsController();

                //$status = ($car->get_status($_GET['car_id']))[0]["status"];
                                     
                $car_id = $_GET['car_id'];
                unset($_GET["car_id"]);

                $data = array(
                    "car_id" => $car_id,
                    "values" => $_GET
                );

                $myfile = fopen("check_up.txt", "r");
                $r = fread($myfile,filesize("check_up.txt"));
                fclose($myfile);

                $status = "";
                
                //check if text in file if content two value (to print clear)
                if (filesize("check_up.txt") > 1)
                    $status = explode(",",$r);
                else
                    $status = $r;
                
                if ($status[0] == 1)
                {     
                    //if part 2 from string equal 1 => this mean the button clear is click on it
                    if (isset($status[1]) && $status[1] == 1)
                    {
                        echo "clear"; 
                        //Delete 1 From Part two
                        $file = fopen("check_up.txt","w");
                        $txt = "1";
                        fwrite($file,$txt);
                        fclose($file);
                    }
                        
                    $result = $this->prepareCheckUp($data);
                    header('Content-Type: application/json');

                   echo json_encode("check");
                }
                else
                {
                    $result = $this->prepareError($data);
                    if ($result == 1){
                    
                    header('Content-Type: application/json');
                    
                   echo json_encode("done");
                        
                    
                        
                    }else{
                        echo $result;  
                    }
                }       
                    
            }
 
        }


        private function prepareCheckUp($data)
        {
            $e = new ErrorsController();

            $result = array();

            extract($data);
            
            foreach ($values as $key => $value)
            {
                if (!empty($e->get_error($value)))
                {
                    $r = ($e->get_error($value))[0];
                    $val = $value . "-" . $r["name"];
                    array_push($result, $val);
                }

            }
            //check if result content errors
            if (!empty($result))
            {
                $data = array(
                    "values" => $result,
                    "car_id" => $car_id
                );

                $car = new CarsController();

                //send errors to database
                if ($car->add_diagnosed($data))
                {
                    //done send
                    return 1;
                }
                else
                {
                    return "error add";
                }
            }
            else
            {
                return "not any error in values";
            }
        }

        private function prepareError($data)
        {
             $car = new CarsController();


            $errors = array(
                "value1" => "cooling Temp",
                "value2" => "Engine RPM",
                "value3" => "Intake Manifold Absolute Pressure",
                "value4" => "Mass Air Flow",
                "value5" => "Throttle Position",
                "value6" => "vehicle speed"
            );
            
            $signs = array(
                "value1" => "C",
                "value2" => "RPM",
                "value3" => "kPa",
                "value4" => "grams/Sec",
                "value5" => "%",
                "value6" => "km/h"
            );
            
            $result = array();

            extract($data);
            $i = 0;
            foreach ($values as $key => $value)
            {
                /* First Part
                //check if value is exist
                if (isset($errors[$key]["name"]))
                {
                    //get range
                    $range = explode("-",$errors[$key]["range"]);
                    if (!($value >= $range[0] && $value <= $range[1]))
                    {
                        //save error name
                        //array_push($result,$errors[$key]["name"]);
                        
                        //save error value
                        array_push($result,$value);    
                    }
                }*/
                

                    
                if (isset($errors[$key]))
                {
                    if ($i == 0 && $value < 0)
                    {
                        $last_error = ($car->get_last_history($car_id))[0];
                        $t = json_decode($last_error["errors"]);
                        $one = 0;
                        $temp = (explode(":",$t->$one))[1];
                        $value = $temp;
                        $i = -1;
                    }
                
                    array_push($result,$errors[$key] . " : " . $value . " " . $signs[$key]);          
                }

            }

            //check if result content errors
            if (!empty($result))
            {
                $data = array(
                    "errors" => $result,
                    "car_id" => $car_id
                );

               
                //send errors to database
                if ($car->new_error_car($data))
                {
                    //done send
                    return 1;
                }
                else
                {
                    return "error add";
                }
            }
            else
            {
                return "not any error in values";
            }
            
        }

    }
?>