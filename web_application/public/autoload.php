<?php 

function specialUrl()
{

    $url = $_SERVER['REQUEST_URI'];

    $url = trim($url,"/");
    $url = explode("/",$url);

    if (isset($url[0]) && $url[0] == "cars" && isset($url[1]) && $url[1] == "public")
    {
        return true;    
    }

    return false;

}



define("DS",DIRECTORY_SEPARATOR);

define("ROOT_PATH",dirname(__DIR__).DS);

define("ROOT_PATH","../");

define("APP",ROOT_PATH.'app'.DS);

define("CORE",APP.'Core'.DS);

define("CONFIG",APP.'Config'.DS);

define("CONTROLLERS",APP.'Controllers'.DS);

define("MODELS",APP.'Models'.DS);

define("VIEWS",APP.'Views'.DS);

define("INC",VIEWS.'include'.DS);

define("LIBS",APP.'Libs'.DS);

if (specialUrl())
    define("BASE_URL","/cars/public/");
else
    define("BASE_URL","/");


/*
configuration files 

require_once(CONFIG.'config.php');
require_once(CONFIG.'helpers.php');
*/

// autoload all classes 
$modules = [ROOT_PATH,APP,CORE,VIEWS,CONTROLLERS,MODELS,CONFIG];
// set_include_path(get_include_path(). PATH_SEPARATOR.implode(PATH_SEPARATOR,$modules));
// spl_autoload_register('spl_autoload',false);

foreach ($modules as $mod)
{
    foreach (glob($mod."*.php") as $file)
    {
        require_once($file);
    }
}



new App();


?>