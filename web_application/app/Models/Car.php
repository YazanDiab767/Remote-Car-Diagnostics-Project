<?php

    date_default_timezone_set('Asia/Jerusalem');

    class Car extends DB
    {

        private $table = "cars";

        //get all cars join data ( drivers , errors )
        public function get_all_cars($car_id = 0)
        {
            
            $condition = "";
            if ($car_id != 0)
                $condition = "WHERE cars.car_id = $car_id";


            $sql = 
            "SELECT drivers.name,drivers.phone_number,cars.car_id,cars.`type` FROM cars

            INNER JOIN drivers
            
            ON cars.driver_id = drivers.driver_id

            $condition
            ";

            return $this->query($sql);
        }

        //get last update error to car
        public function get_last_update_error($car_id)
        {
            $sql = 
            "SELECT * FROM history
            WHERE history.car_id = '$car_id' and history.dt >= CURDATE() and history.fixed_it = 0
            ORDER BY history.history_id DESC LIMIT 1";

            return $this->query($sql);
        }

        //get all update errors for all cars
        public function get_all_last_update()
        {
            $sql = "SELECT cars.car_id FROM cars WHERE 1";
            $ids = $this->query($sql);

            $data = array();

            for ($i = 0; $i < count($ids);$i++)
            {
                $id = $ids[$i]["car_id"];

                $data[$i]["car_id"] = $id;
                if ($this->get_last_update_error($id)) 
                {
                    $his_data = $this->get_last_update_error($id);
                    $data[$i]["data"] = $his_data[0];
                }
                
            }

            return $data;

        }

        //get history for car
        public function get_history($id,$limit = "0,10")
        {

            $sql = "SELECT * FROM history WHERE history.car_id = '$id'
            ORDER BY history.history_id DESC
            LIMIT $limit
            ";

            return $this->query($sql);
        }

        //add new error to car
        public function new_error_car($data)
        {
            $data["dt"] = date("Y-m-d");
            $data["time"] = date('h:i:s a');

            $d = array(
                "table" => "history",
                "data" => $data
            );
            return $this->insert($d);   
        }

        public function add_error_car($data)
        {
            $sql = "INSERT INTO $data (column1, column2, column3, ...)
                VALUES (value1, value2, value3, ...)";
        }

        public function get_errors()
        {
            $sql = "SELECT * FROM errors WHERE 1";
            return $this->query($sql);
        }

        public function delete_error($id)
        {
            $data = array(
                "table" => "errors",
                "condition" => "error_id='$id'"
            );
            return $this->delete($data);
        }

        public function delete_car($id)
        {
            $data = array(
                "table" => $this->table,
                "condition" => "car_id='$id'"
            );
            return $this->delete($data);
        }

        public function new_error($data)
        {
            $d = array(
                "table" => "errors",
                "data" => $data
            );

            return $this->insert($d);
        }

        public function get_cars()
        {
            $sql = "SELECT * FROM cars
            INNER JOIN drivers ON cars.driver_id = drivers.driver_id";
            return $this->query($sql);   
        }

        public function new_car($data)
        {
            $d = array(
                "table" => $this->table,
                "data" => $data
            );   
            return $this->insert($d);
        }

        public function new_diagnosed($data)
        {
            extract($data);
            $d = array(
                "table" => $this->table,
                "columns" => $data,
                "condition" => "car_id='$car_id'"
            );   
            return $this->update($d);
        }

        public function get_last_diagnosed($car_id)
        {
            
            $data = array(
                "columns" => "last_diagnosed",
                "condition" => "car_id = '$car_id'",
                "table" => $this->table
            );
            
            $a = array(
                "last_diagnosed" => "{name:'yazan'}"
            );
            //return $a;
            return $this->select($data);
        }
        
        public function delete_diagnosed($car_id)
        {
            $data = array(
                "last_diagnosed" => ""
            );
            $d = array(
                "table" => $this->table,
                "columns" => $data,
                "condition" => "car_id=$car_id"
            );   
            return $this->update($d); 
        }

        public function get_status($car_id)
        {
            $data = array(
                "columns" => "status",
                "condition" => "car_id = $car_id",
                "table" => $this->table
            );

            return $this->select($data);
        }

        public function set_status($data)
        {
            extract($data);
            $d = array(
                "table" => $this->table,
                "columns" => $data,
                "condition" => "car_id=$car_id"
            );   
            return $this->update($d);  
        }
        
        public function add_errors_to_table()
        {
            $myfile = fopen("errors.txt", "r");
            $row = array();
            $i = 1;
            while ($line = fgets($myfile)) {
                $row = explode("*",$line);
                $data = array(
                    "error_id" => $row[0],
                    "name" => $row[1]
                );
                $this->insert(array(
                    "data" => $data,
                    "table" => "errors"
                ));
                echo "Success $i <br/>";
                $i++;
            }
        }
        
        public function get_last_history($car_id)
        {
            return $this->query("SELECT errors FROM `history` WHERE car_id = '$car_id' ORDER BY history_id DESC LIMIT 1");
        }

    }

?>