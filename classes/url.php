<?php

class Url{
    
public function parm_exists($name){
    return isset($_GET[$name]) ? true : false;
}    
public function get_parm($name){
     if(isset($_GET[$name])&& $_GET[$name]!=="") {
         return $_GET[$name]; }
    }


public function get_page($name){
    $parm = $this->get_parm($name);
     if($parm){
         $page_dir = $parm.".php";
         is_file ($page_dir) ? include $page_dir : include "error.php";
     }
}    
    
}