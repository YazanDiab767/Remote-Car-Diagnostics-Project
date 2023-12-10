<?php

    if (!function_exists("url"))
    {
        function url($url)
        {
            return BASE_URL.trim($url,"/");
        }
       
    }



if($_GET['i'] == 1 && count($_GET) == 1){

    header('location: /cars/public');
}

   
        ob_get_clean();
    ob_start();
                        
                 
   require_once('autoload.php');
   
       ob_end_clean();
       
        ob_end_flush();

?>