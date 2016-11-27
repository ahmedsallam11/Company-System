<?php

class Supervisors extends Inst {
    
    public function fetch_all_supervisors(){
$sql = "SELECT supervisors.fName AS supFname,
supervisors.supervisorID AS supID,
supervisors.lname AS supLname,
supervisors.salary AS supSalary,
departments.departmentname AS supDepartment,
employees.fName As empFname,
employees.lname As empLname  
FROM supervisors INNER JOIN employees ON (
    supervisors.supervisorID = employees.supervisorID)
INNER JOIN departments ON (
supervisors.departmentID = departments.departmentID
)";
       $result = $this->db->fetch_all($sql);
        if ($result){
            return $result;
        }
    }
}