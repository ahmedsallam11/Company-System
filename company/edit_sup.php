<?php 
require_once "config.php"; 
?>

         <h2>Edit Employee!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1 "><!--table col-->

<?php  
  $obj_url = new Url();       
$parmExists = $obj_url->parm_exists("supID");       
$supID = $obj_url->get_parm("supID"); 
$obj_emp = new Employees ();      
   if(Input::check()){
$input = new Input();       
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
    $obj_emp->update_emp("employees",array('fName'=>$input->get("fName"),'lName'=>$input->get("lName"),'salary'=>$input->get("salary"),'departmentID'=>$input->get("department")),"employeeID",$supID);        
 } else {   
 $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);}}
if(Validate::valid_ID($supID)){       
$supArray= $obj_emp->fetch_sup_byID($supID);}           
if(!empty($supArray)){        
$obj_dep = new Departments ();     
$all_dep = $obj_dep->fetch_all_departments();     
    $n =1;
foreach ($supArray as $sup){
$empFname = $sup['emp_fName'];
$empLname = $sup['emp_lName'];
$empsalary = $sup['salary'];
$empDepartment = $sup['departmentName']; 
$empDepID = $sup['depID'];
} 
?> 
    <form method="post" action="">    
  <div class="form-group">
    <label for="fName">First Name</label>
    <input type="text" class="form-control" name="fName" id="fName" value="<?php echo $empFname;?>">
  </div>
  <div class="form-group">
    <label for="lName">Last Name</label>
    <input type="text" class="form-control"  name="lName" id="lName" value="<?php echo $empLname; ?>">
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <input type="number" class="form-control" name="salary" id="lName" value="<?php echo $empsalary; ?>">
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
  <button type="submit" name="update" class="btn btn-default">Submit</button>
</form><?php } else{
        echo Helper::error("NO DATA FOUND");}
        ?>

        
</div><!--/table col-->
</div><!--/Main Row-->
<?php require_once STYLE_DIR."/footer.php" ?> 
