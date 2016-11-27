<?php 
require_once "config.php"; ?>

         <h2 style="position:relative;margin-left:20px;">Welcome to employees!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1"><!--table col-->
<a href="?page=add_emp"><button class="btn btn-success">Add New</button></a><br><br>
<table class="table  table-bordered">
  <thead>
      <th>N</th> 
      <th>First name</th> 
      <th>Last name</th> 
      <th>Department</th> 
      <th>Supervisor</th> 
      <th>Salary</th>
      <th>Options</th> 
  </thead>
<tbody>  
<?php
$obj_emp = new Employees ();
$get = new Url();
$supID = $get->get_parm("supID");   
$EmpID = $get->get_parm("delet");
if(Validate::valid_ID($EmpID)){
$deleteEmp = $obj_emp->deleEmp("employees","employeeID",$EmpID);
if($deleteEmp){Helper::redirect("ordinary_employees");}    
}
if(Validate::valid_ID($supID)){
$all_emp = $obj_emp->fetch_ordEmp_forSup($supID);}
else {$all_emp = $obj_emp->fetch_all_ord_emp();}
if(!empty($all_emp)){     
    $n =1;
foreach ($all_emp as $emp){
if($emp['supfName']==""&& $emp['suplName']==""){
  $emp['supfName'] = "None"; }    
echo "<tr>";    
echo "<td>{$n}</td>";    
echo "<td>{$emp['emp_fName']}</td>";
echo "<td>{$emp['emp_lName']}</td>";
echo "<td>{$emp['departmentName']}</td>";
echo "<td>{$emp['supfName']}";
echo " ";    
echo "{$emp['suplName']}</td>";    
echo "<td>{$emp['salary']}</td>";
echo "<td><a href='?page=edit_emp&empID={$emp['employeeID']}'>Edit</a>&nbsp;&nbsp;&nbsp;";
echo "<a href='?page=ordinary_employees&delet={$emp['employeeID']}'>Delete</a></td>";       
echo "</tr>";    
$n++; }?> 
</tbody>      
</table>
<?php } else {echo Helper::error("NO DATA FOUND!");} ?>        
</div><!--/table col-->
</div><!--/Main Row-->
  <?php require_once STYLE_DIR."/footer.php" ?> 


