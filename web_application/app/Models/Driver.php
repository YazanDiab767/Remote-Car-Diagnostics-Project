<?php

    class Driver extends DB
    {
        private $table = "drivers";

        public function get_all_drivers()
        {
            $data = array(
                "table" => $this->table
            );
            return $this->select($data);
        }

        public function new_driver($data)
        {
            return $this->insert(array(
                "table" => $this->table,
                "data" => $data
            ));
        }

        public function delete_driver($id)
        {
            $data = array(
                "table" => $this->table,
                "condition" => "driver_id=$id"
            );

            return $this->delete($data);
        }

    }


?>