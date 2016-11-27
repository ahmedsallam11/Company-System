<?php 
require_once "config.php"; 
require_once "init.php"; ?>

         <h2>Edit Employee!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1 "><!--table col-->

<?php 
$input = new Input();         
$obj_emp = new Employees ();  
$obj_url = new Url();
$parmExists = $obj_url->parm_exists("empID");
$empID = $obj_url->get_parm("empID");   
   if(Input::check()){
       $obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'fName'=> array(
        'required'=> true,
        'min'=> 2,
        'max'=>50,
        'onlyLetters'=>true
    ),
    'lName'=> array(
        'required'=> true,
        'min'=> 2,
        'max'=>50,
        'onlyLetters'=>true
    ),    
    'salary'=> array(
        'required'=> true,
        'positive'=> true,
        'min'=> 2,
        'max'=> 7 )    
    )) ;  
  
   $errors =  $obj_validate->errors;
    if($obj_validate->passed){
    $obj_emp->update_emp("employees",array('fName'=>$input->get("fName"),'lName'=>$input->get("lName"),'salary'=>$input->get("salary"),'departmentID'=>$input->get("department"),'supervisorID'=>$input->get("supervisor")),"employeeID",$empID);        
 } else {   
 $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);}
   } 
if(Validate::valid_ID($empID)){       
$all_emp = $obj_emp->fetch_ordEmployee_byID($empID);}
if(!empty($all_emp)){        
$obj_dep = new Departments ();
$all_dep = $obj_dep->fetch_all_departments();        
   
    $n =1;
foreach ($all_emp as $emp){
$empFname = $emp['emp_fName'];
$empLname = $emp['emp_lName'];
$empsalary = $emp['salary'];
$empDepartment = $emp['departmentName']; 
$empSupID =  $emp['empSupID'];   
$empSupervisor = $emp['supfName']." ".$emp['suplName'];
$empDepID = $emp['empDepID'];
$empSupID = $emp['empSupID'];
} 
$all_sup = $obj_emp->fetch_allSup_byDep($empDepID);         
?> 
    <form method="post" action="">    
  <div class="form-group">
    <label for="fName">First Name</label>
    <input type="text" class="form-control" name="fName" id="fName" onkeyup="valfName()" value="<?php echo $empFname;?>"><lable id="fNameMessa" for="fName"></lable>
  </div>
  <div class="form-group">
    <label for="lName">Last Name</label>
    <input type="text" class="form-control"  name="lName" id="lName" onkeyup="valLName()" value="<?php echo $empLname; ?>"><lable id="lNameMessa" for="lName"></lable>
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>&nbsp;&nbsp;<lable id="salaryMessa" for="salary"></lable>
    <input type="number" class="form-control" name="salary" id="salary" onkeyup="valsalary()"  value="<?php echo $empsalary; ?>">
  </div>
   <div class="form-group"> 
 <label for="department" >Department</label>       
<select name="department" id="department" class="form-control">
     <?php 
    foreach ($all_dep as $dep){ 
    if ($dep['departmentID'] == $empDepID){ ?>
  <option value="<?php echo $dep['departmentID']; ?>" selected><?php echo $dep['departmentName']; ?></option> 
    <?php } else { ?>
  <option value="<?php echo $dep['departmentID']; ?>" ><?php echo $dep['departmentName']; ?></option>
       <?php }} ?>
</select>
</div>   
   <div class="form-group"> 
 <label for="supervisor">Supervisor</label>       
<select name="supervisor" id="supervisor" class="form-control">
   <?php 
    if($empSupID ==0){ ?>
    <option value="0" selected>None</option> <?php }
    else { ?>
    <option value="0" selected>None</option> <?php }
    foreach ($all_sup as $sup){
    if ($sup['employeeID'] == $empSupID){ ?>
  <option value="<?php echo $sup['employeeID']; ?>" selected><?php echo $sup['emp_fName']." ".$sup['emp_lName']; ?></option> 
    <?php } else { ?>
  <option value="<?php echo $sup['employeeID']; ?>" ><?php echo $sup['emp_fName']." ".$sup['emp_lName']; ?></option>
       <?php }} ?>
</select>
</div>     
  <button type="submit" name="updateEmp" class="btn btn-default">Submit</button>
</form><?php } else{
    echo Helper::error("NO DATA FOUND!");
}?>

        
</div><!--/table col-->
</div><!--/Main Row-->
<?php require_once STYLE_DIR."/footer.php" ?> 
