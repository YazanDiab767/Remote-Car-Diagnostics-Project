<?php

    class ErrorsController
    {

        
        public function get_error($error_id)
        {
            $e = new Errors();
            return $e->select_error($error_id);
        } 

    }

?>