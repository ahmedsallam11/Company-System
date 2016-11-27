<?php
class Inst{
    public $db = null;
    function __construct(){
        if(!isset($this->db)){
            $this->db = new Database();
        }
    }
    
}