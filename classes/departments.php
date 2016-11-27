<?php

class Departments extends Inst {
  
  private function redirect($dir){
return header("Location:?page={$dir}");
    }  
    
    public function fetch_all_departments(){
$sql = "SELECT * FROM departments";
       $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }}
    
      public function fetchDepbyID($ID){
$sql = "SELECT * FROM departments WHERE departmentID = {$ID}";
       $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }}  
public function addNew_dep($table,$items){
$result = $this->db->insert($table,$items);
if($result) {
$this->redirect("departments");   
      }
    }
 public function update_dep($table,$items,$byName,$byValue){
$result = $this->db->update($table,$items,$byName,$byValue);
return ($result)? true : false;
    }   
public function deleDep($table,$byName,$byValue){
$result = $this->db->deleteRow($table,$byName,$byValue);
if ($result){
$this->redirect("departments"); } 
    }    
}