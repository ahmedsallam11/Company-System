
<?php 
require_once "config.php"; 
?>
 
         <h2>Add New Employee!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1 "><!--table col-->
<?php
$obj_emp = new Employees();
$obj_dep = new Departments();
$input = new Input();
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
       $add_new = $obj_emp->addNew_emp("employees",array('fName'=>$input->get("fName"),'lName'=>$input->get("lName"),'salary'=>$input->get("salary"),'departmentID'=>$input->get("department"),'titleID'=>$input->get("title"),'supervisorID'=>$input->get("supervisor")));
    if($obj_emp->success){
        echo Helper::success("A New Employee Has Been Added!");
    }}else {
  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);
    }   
}              
$all_dep = $obj_dep->fetch_all_departments();        
$all_sup = $obj_emp->fetch_allSup();
       
?> 
    <form method="post" action="">    
  <div class="form-group">
    <label for="fName">First Name</label>
      <input type="text" onkeyup="valfName()" class="form-control" name="fName" id="fName" value=""><lable id="fNameMessa" for="fName"></lable>
  </div>
  <div class="form-group">
    <label for="lName">Last Name</label>
    <input type="text" class="form-control" onkeyup="valLName()" name="lName" id="lName" value=""><lable id="lNameMessa" for="lName"></lable>
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>&nbsp;&nbsp;<lable id="salaryMessa" for="salary"></lable>
    <input type="number" class="form-control" onkeyup="valsalary()" name="salary" id="salary" value="">
  </div>
        
   <div class="form-group"> 
 <label for="department" >Department</label>       
<select name="department" id="department" class="form-control">
   <?php 
    foreach ($all_dep as $dep){ ?> 
  <option value="<?php echo $dep['departmentID']; ?>" ><?php echo $dep['departmentName']; ?></option>
     <?php } ?>
</select>
</div>   
        
   <div class="form-group"> 
 <label for="title">Title: &nbsp;&nbsp;</label>
<label for="supervisorRadio">Supervisor&nbsp;</label>       
 <input type="radio" name="title" id="supervisorRadio" value="1" onClick="changeEl()" >&nbsp;&nbsp;&nbsp;
<label for="ordinaryRadio">Ordinary&nbsp;</label>        
<input type="radio" name="title" id="ordinaryRadio" value="2" onClick="changeEl()" checked>       
   </div> 
        
   <div class="form-group" id="showSup"> 
 <label for="supervisor">Supervisor</label>       
<select name="supervisor" id="supervisor" class="form-control">
    <option value="0" selected>None</option>
   <?php     
    foreach ($all_sup as $sup){ ?>
  <option value="<?php echo $sup['employeeID']; ?>" ><?php echo $sup['emp_fName']." ".$sup['emp_lName']." ({$sup['departmentName']})"; ?> </option>
       <?php } ?>
</select>
</div>  
        
  <button type="submit" name="update" class="btn btn-default">Submit</button>
</form>
        
<script type="text/javascript">  
var showSup =document.getElementById("showSup");
var ordSelected =document.getElementById("ordinaryRadio");
function changeEl(){    
if(ordSelected.checked){
   showSup.style.display='block'; 
}else{showSup.style.display='none';}}
</script>
     
</div><!--/table col-->
</div><!--/Main Row-->
<?php require_once STYLE_DIR."/footer.php" ?> 
