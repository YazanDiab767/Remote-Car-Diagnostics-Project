<?php

    date_default_timezone_set('Asia/Jerusalem');

    class User extends DB
    {

        private $table = "users";

        public function login($data)
        {
            extract($data);

            return $this->select(
                array(
                    "table" => $this->table,
                    "condition" => "username = '$username' AND password = '$password'"
                )
            );
        }

        public function edit($data)
        {
            extract($data);

            $d = array(
                "table" => $this->table,
                "columns" => $cols,
                "condition" => "user_id=$user_id"
            ); 
            return $this->update($d);
            
        }

    }

?>