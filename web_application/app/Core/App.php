<?php

    class App
    {
        protected $controller = "IndexController";
        protected $action = "index";
        protected $params = [];

        public function __construct()
        {
            $this->prepareURL();
            $this->render();

        }

        private function prepareURL()
        {

            $url = $_SERVER['REQUEST_URI'];   
            

            if (!empty($url))
            {

                $url = trim($url,"/");
                $url = explode("/",$url);


                $controllerIndex = 0;
                $actionIndex = 1;
                $specialURL = false;

                if (isset($url[0]) && $url[0] == "cars" && isset($url[1]) && $url[1] == "public")
                {
                    $controllerIndex = 2;
                    $actionIndex = 3;
                    $specialURL = true;
                }


                if (isset($url[$controllerIndex]) && !empty($url[$controllerIndex]))
                    $this->controller = ucwords($url[$controllerIndex]) . "Controller";

                if (isset($url[$actionIndex]) && !empty($url[$actionIndex]))
                    $this->action = ucwords($url[$actionIndex]);

                if ($specialURL)
                {
                    unset($url[0],$url[1]);
                }
                
                unset($url[$controllerIndex],$url[$actionIndex]);

                if (!empty($url))
                {
                    $this->params = array_values($url);
                }


            }


        }

        private function error()
        {
            View::load("include/error404");
        }

        private function render()
        {

            //$this->controller = APP.'Controllers'.DS.'CarsController.php';
            //echo $this->controller . " and " . $this->action;
            if (class_exists($this->controller))
            {
                $controller = new $this->controller;
                if (method_exists($controller,$this->action))
                {
                    if ($this->action == "adderror" || $this->action == "addError")
                    {
                        echo call_user_func_array([$controller,$this->action],$this->params);

                    }
                    else
                    {
                    ob_get_clean();
                    call_user_func_array([$controller,$this->action],$this->params);
                    }
                }
                    
                else 
                    $this->error();
                    //echo "The method : " . $this->action . " is not exist ";
            }
            else
            {
                //echo " The controller : " . $this->controller . " is not exist ";
                $this->error();
            }

        }

    }

?>