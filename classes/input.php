<?php

class Input extends Inst{
    
    
    public static function check(){
        return (isset($_POST)&&!empty($_POST))? true : false;}
    

    public function get($item){
   if (Input::check()){
    $escaped_post = $this->db->esacpe_str($_POST[$item]);
    return $escaped_post; }
    }
    
    
}