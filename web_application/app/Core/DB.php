<?php

/*
	Notes ...
*/

    class DB
    {

        private $con;
        private $errors = array(
            "connect"=>"Falid connect with database",
            "table"=>"Should enter a table name",
            "data"=>"Should send data",
            "columns"=>"Should send columns and values"
        );

        final function __construct()
        {
            $this->connect();
		}
        
        
        //Main ...
        
        protected function connect()
        {
            $con = mysqli_connect("localhost","root","","cars");
            if ($con)
            {
                $this->con = $con;
                return 1;
                
            }
            else
            {
                return $this->errors["connect"];
            }            
        }

        final protected function select($data)
        {    
            extract($data);

            $columns;
            $condition;
            $table;
            
            if (!isset($columns))
                $columns = "*";
             
            if (!isset($condition))
                $condition = "1";
                
            if (isset($table))
            {
                $select = mysqli_query($this->con,"SELECT $columns FROM `$table`  WHERE $condition");
                $d = array();
    
               while ($row = mysqli_fetch_assoc($select))
                    array_push($d,$row); 
    
                return $d; 
            }
            else
            {
                return $this->errors["table"];
            }

		}

        final protected function insert($n_data)
        {        
            extract($n_data);

            if (isset($table))
            {         
                $columns = "";
                $values = "";

                foreach($data as $key => $value)
                {
                    $columns .= "`$key`,";
                    $values .= "'$value',";
                }

                $columns = trim($columns,",");
                $values = trim($values,",");
//                echo " INSERT INTO `$table` ($columns)  VALUES ($values) ";
                return mysqli_query($this->con,"INSERT INTO `$table` ($columns)  VALUES ($values)");
            }
            else
            {
                return $this->errors["table"];
            }
		}

        final protected function delete($data)
        {
            if (isset($data["table"]))
            {
                $table = $data["table"];
                $condition = $data["condition"];
                return mysqli_query($this->con,"DELETE FROM `$table` WHERE $condition");
            }
            else
            {
                return $this->errors["table"];
            }

		}

        final protected function update($data)
        {
            if (isset($data["table"]))
            {
                $update = "";

                extract($data);

                foreach ($columns as $col => $value) {
                    $update .= "`$col`= '" . $value ."',";   
                }

                $update = trim($update,",");

                return mysqli_query($this->con,"UPDATE `$table` SET $update  WHERE $condition");
            }
            else
            {
                return $this->errors["table"];
            }
        }

        final protected function query($q)
        {
            $select =  mysqli_query($this->con,$q);
            $data = array();
            while ($row = mysqli_fetch_assoc($select))
            {
                array_push($data,$row);
            }
            return $data;
        }

	}
?>
