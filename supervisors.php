<?php 
require_once "config.php"; ?>

         <h2>Welcome to supervisors!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1"><!--table col-->
<table class="table  table-bordered">
    <a href="?page=add_emp"><button class="btn btn-success">Add New</button></a><br><br>
  <thead>
      <th>N</th> 
      <th>First name</th> 
      <th>Last name</th> 
      <th>Department</th>  
      <th>Salary</th>
      <th>Sub-Employees</th>
      <th>Options</th>
  </thead>
<tbody>  
<?php
$obj_emp = new Employees ();    
$get = new Url();
$EmpID = $get->get_parm("delet");
if(Validate::valid_ID($EmpID)){
$deleteEmp = $obj_emp->deleEmp("employees","employeeID",$EmpID);
if($deleteEmp){Helper::redirect("supervisors");}    
}     
$all_sup = $obj_emp->fetch_allSup();
if(!empty($all_sup)){  
    $n =1;
foreach ($all_sup as $sup){
echo "<tr>";    
echo "<td>{$n}</td>";    
echo "<td>{$sup['emp_fName']}</td>";
echo "<td>{$sup['emp_lName']}</td>";
echo "<td>{$sup['departmentName']}</td>";
echo "<td>{$sup['salary']}</td>";     
$ordEmpforSup =$obj_emp->fetch_ordEmp_forSup($sup['employeeID']);
if(!empty($ordEmpforSup)){
    $subEmpArray = array();
    foreach ($ordEmpforSup as $subEmp){
     $subEmpfName = $subEmp['emp_fName'];
     $subEmplName = $subEmp['emp_lName'];
      $subEmpArray [] = "{$subEmpfName}&nbsp{$subEmplName}";        
    }$subEmpString = implode("<br>",$subEmpArray);    
}
echo "<td><a href='?page=ordinary_employees&supID={$sup['employeeID']}'>See</a></td>"; 
echo "<td><a href='?page=edit_sup&supID={$sup['employeeID']}'>Edit</a>&nbsp;&nbsp;&nbsp;";
echo "<a href='?page=supervisors&delet={$sup['employeeID']}'>Delete</a></td>";     
echo "</tr>";    
$n++; }?> 
</tbody>      
</table>
<?php } else {echo Helper::error("NO DATA FOUND!");} ?>        
</div><!--/table col-->
</div><!--/Main Row-->
  <?php require_once STYLE_DIR."/footer.php" ?> 
