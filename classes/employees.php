<?php

class Employees extends Inst {
    public $success = false,
           $failure = false;
private function refresh(){
return header("Refresh:0");
    }
private function redirect($dir){
return header("Location:?page={$dir}");
    }    
//    public function fetch_all_employees(){
//$sql = "SELECT employees.employeeID AS employeeID,
//employees.fName AS emp_fName,
//employees.lName AS emp_lName,
//employees.salary As salary,
//departments.departmentName AS departmentName,
//supervisors.fName AS supfName,
//supervisors.lname AS suplName
//FROM employees INNER JOIN departments ON ( employees.departmentID = departments.departmentID) INNER JOIN supervisors ON( employees.supervisorID = supervisors.supervisorID )";
//       $result = $this->db->fetch_all($sql);
//        if ($result){
//            return $result;
//        }else{return false;}
//    }
    public function fetch_all_ord_emp(){
        $sql = "SELECT emp2.employeeID AS employeeID, emp2.fName AS emp_fName, emp2.lName AS emp_lName, emp2.salary AS salary, dep.departmentName AS departmentName, emp1.fName AS supfName, emp1.lName AS suplName FROM employees emp1 RIGHT JOIN employees emp2 ON(emp1.employeeID = emp2.supervisorID) INNER JOIN departments dep ON ( emp2.departmentID = dep.departmentID) WHERE emp2.titleID=2";
               $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        } else{return false;}
    }
    
    public function fetch_ordEmployee_byID($empID){
$sql = "SELECT emp2.employeeID AS employeeID,
emp2.fName AS emp_fName,
emp2.lName AS emp_lName,
emp2.salary AS salary,
emp2.departmentID AS empDepID,
emp2.supervisorID AS empSupID,
dep.departmentName AS departmentName,
emp1.fName AS supfName,
emp1.lName AS suplName
 FROM employees emp1 RIGHT JOIN employees emp2 ON(emp1.employeeID = emp2.supervisorID)
 INNER JOIN departments dep ON ( emp2.departmentID = dep.departmentID) WHERE emp2.employeeID ={$empID} AND emp2.titleID=2";
       $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }else{return false;}
    }
    
public function fetch_allSup(){
        $sql = "SELECT emp1.employeeID AS employeeID,
emp1.fName AS emp_fName,
emp1.lName AS emp_lName,
emp1.salary AS salary,
dep.departmentName AS departmentName
 FROM employees emp1
 INNER JOIN departments dep ON ( emp1.departmentID = dep.departmentID) WHERE titleID = 1";
               $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        } else{return false;}
} 

    public function fetch_allSup_byDep($depID){
            $sql = "SELECT emp1.employeeID AS employeeID,
emp1.fName AS emp_fName,
emp1.lName AS emp_lName,
emp1.salary AS salary,
dep.departmentName AS departmentName
 FROM employees emp1
 INNER JOIN departments dep ON ( emp1.departmentID = dep.departmentID) WHERE titleID = 1 AND emp1.departmentID ={$depID} ";
               $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        } else{return false;}  
 
    }
    
 public function fetch_sup_byID($ID){
        $sql = "SELECT emp1.fName AS emp_fName,
emp1.lName AS emp_lName,
emp1.salary AS salary,
emp1.departmentID AS depID,
dep.departmentName AS departmentName
 FROM employees emp1
 INNER JOIN departments dep ON ( emp1.departmentID = dep.departmentID) WHERE emp1.employeeID = {$ID} AND emp1.titleID =1";
               $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }else{return false;}
 }    
    
    public function fetch_ordEmp_forSup($ID){
    $sql = "SELECT emp2.employeeID AS employeeID, emp2.fName AS emp_fName, emp2.lName AS emp_lName, emp2.salary AS salary, dep.departmentName AS departmentName, emp1.fName AS supfName, emp1.lName AS suplName FROM employees emp1 RIGHT JOIN employees emp2 ON(emp1.employeeID = emp2.supervisorID) INNER JOIN departments dep ON ( emp2.departmentID = dep.departmentID) WHERE emp2.titleID=2 AND emp1.employeeID={$ID}";   
       $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }else{return false;}   
    }
    
    public function addNew_emp($table,$items){
      $result = $this->db->insert($table,$items);
      if($result) {
$this->redirect("add_emp");   
      }
    }
    
  public function update_emp($table,$items,$by_name,$empID){
    $result = $this->db->update($table,$items,$by_name,$empID);  
    if ($result){
$this->refresh();
    }
  }  
    
 public function deleEmp($table,$byName,$byValue){
   $result = $this->db->deleteRow($table,$byName,$byValue);
    if ($result){
return true; } else {return false;}    
 }    
    
}    
