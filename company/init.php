<?php
function __autoload($class){
    $className = lcfirst($class);
    require_once ("classes/".$className.".php");
    
}
