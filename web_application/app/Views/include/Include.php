<?php


    // This Class To Reqqire Files Assets ( css / javascript / images) and ( head / footer ) page


    class Includs
    {
        private $head = ["bootstrap.min","all.min","rtl","main"];
        private $footer = ["jquery","bootstrap.min","all.min","core"];
        private $url;
        
        public function __construct()
        {   
            $this->url .= "assets";
        }

        public function file($data)
        {
            if ($data["type"] == "css")
            {
                $url_cp = $this->url . "/css/";
                echo'<link rel="stylesheet" href="' . url($url_cp . $data["name"] ). '.css" />';
            }
            else if ($data["type"] == "js") 
            {
                $url_cp = $this->url . "/js/";

              echo  sprintf('<script src="%s.js" /></script>',url($url_cp.$data['name']));
             
            }  
        }
        
        public function head()
        {
           
            echo
            '
                <link rel="icon" href="'.url("assets/images/question.png").'">
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
            ';
            $url_cp = $this->url . "/css/";
            for ($i = 0; $i < count($this->head);$i++)
            {
                echo'<link rel="stylesheet" href="' . url($url_cp . $this->head[$i] . ".css") . '"/>';
            }
        }

        public function footer()
        {
            //Function Using To Get Length Object
            echo sprintf("<script>var base_url = '%s';
            Object.size = function(obj)
            {
              let size = 0, key;
              for (key in obj)
              {
                if (obj.hasOwnProperty(key))
                  size++;
              }
              return size;
            }</script>",url('/'));

            $url_cp = $this->url . "/js/";
            for ($i = 0; $i < count($this->footer);$i++)
            {
                echo sprintf('<script src="%s.js" /></script>',url($url_cp . $this->footer[$i]));
            }

           
        }

    }



?>