<?php

    date_default_timezone_set('Asia/Jerusalem');

    class Errors extends DB
    {

        private $table = "errors";
        
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
                    "table" => $this->table
                ));
                echo "Success $i <br/>";
                $i++;
            }
        }

        public function select_error($error_id)
        {
            return $this->select(
                array(
                    "table" => $this->table,
                    "condition" => "error_id='$error_id'"
                )
            );
        }

    }

?>