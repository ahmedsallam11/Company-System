<?php
error_reporting( E_ALL );
   ini_set( "display_errors", 1 );
function __autoload($class){
    $className = lcfirst($class);
    require_once ("classes/".$className.".php");
    
}
