<?php

class Database {
    
    private $hostName = "localhost",
            $username = "root",
            $password = "root",
            $dbName   = "company";
    public  $connection, $inst = null;
    
    
    function __construct(){
        $this->connect();
    }
            
    
    private function connect(){
        
    $this->connection = new mysqli($this->hostName,$this->username,$this->password,$this->dbName);
        if(!$this->connection){
            die("DATABASE CONNECTION FAILED!".$this->connection->mysqli_error);
        }
    }
    
    private function close(){
        if(!mysqli_close()){
            die("CLOSING DATABASE CONNECTION FAILED!".$this->connection->mysqli_error);
        }
    }
    
    //Query
    public function query($sql){
     $result = mysqli_query ($this->connection,$sql);
        if(!$result){
 die("Query Failed".$this->connection->mysqli_error);}
        else {return $result;}
        
    }
    
    //Escape strings
    public function esacpe_str($string){
        $escaped_string = mysqli_real_escape_string($this->connection,$string);
        return $escaped_string;
    }
        
   //fetch All
    public function fetch_all($sql){
        $_array = array();
        $result = $this->query($sql);
        while ($row = mysqli_fetch_assoc($result)){
            $_array [] = $row; }
        return $_array;
    }
    
           //Insert into table
    public function insert($table = null,$fields = array()){
        if (!empty($table) && !empty($fields)){
        $keys = array_keys($fields);
        $values = "";
        $n = 1;    
            foreach ($fields as $field){
            $values .= '"';   
            $values .= "$field";
            $values .= '"';    
            if($n < count($fields)){
            $values .=", ";
            } $n++;}
         $sql = "INSERT INTO $table (".implode(", " , $keys).") VALUES ({$values})";
            
        if ($this->query($sql)){
            return true;
        }else{return false;}

    }}
    
       //Update Table By 
    public function update($table = null,$fields = array(),$byName,$byValue){
        if (!empty($table) && !empty($fields)){
//        $keys = array_keys($fields); 
          $value = array();
           foreach ($fields as $key=>$value){      
           $values [] = "{$key}='{$value}'"; }   
           // $values = http_build_query($fields,"",', ');
         $sql = "UPDATE $table SET ".implode(", " , $values)."  WHERE $byName = $byValue";  
        if ($this->query($sql)){
            return true;
        }else{return false;}
        
        }
    }
 
   // Delete Row 
    
    public function deleteRow($table = null,$byName,$byValue){
        if(!empty($table)&&!empty($byValue)){
          $sql = "DELETE FROM {$table} WHERE {$byName}={$byValue}";
         if ($this->query($sql)){
        return true;
        }else{return false;}    
        }
    }
}