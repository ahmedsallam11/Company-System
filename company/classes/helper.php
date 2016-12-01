<?php

class Helper{
    
    public static function refresh(){
        return header("Refresh:0");
    }
    public static function success($message){
       return $result = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{$message}</div>"; 
        
    }
    
      public static function error($message){
       return $result = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{$message}</div>"; 
        
    }  
    
 public static function redirect($dir){
 return header("Location:{$dir}");
    } 
    
 public static function retBack(){
     return header ('Location: '.($_SERVER['HTTP_REFERER']));
 }    
    
}