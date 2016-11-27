<?php 
require_once "config.php"; 
?>

         <h2>Add Department!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1 "><!--table col-->

<?php   
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
  
   $r =  $obj_validate->errors;
       print_r($r);
    if($obj_validate->passed){
        echo "passed";
    }   
}       
$obj_dep = new Departments ();
$all_dep = $obj_dep->fetch_all_departments();
$obj_sup = new Supervisors ();
$all_sup = $obj_sup->fetch_all_supervisors();
$obj_empl = new Employees ();
$all_emp = $obj_empl->fetch_all_employees();
       
  
?> 
    <form method="post" action="">    
  <div class="form-group">
    <label for="fName">First Name</label>
    <input type="text" class="form-control" name="fName" id="fName" value="">
  </div>
  <div class="form-group">
    <label for="lName">Last Name</label>
    <input type="text" class="form-control"  name="lName" id="lName" value="">
  </div>
  <div class="form-group">
    <label for="salary">Salary</label>
    <input type="number" class="form-control" name="salary" id="lName" value="">
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
 <label for="subEmployee">Sub-Employee</label>       
<select name="subEmployee" id="subEmployee" class="form-control">
    <option value="None" selected>None</option>
   <?php     
    foreach ($all_emp as $emp){ ?>
  <option value="<?php echo $emp['employeeID']; ?>"><?php echo $emp['emp_fName']." ".$emp['emp_lName']; ?></option>
       <?php } ?>
</select>
</div>     
  <button type="submit" name="update" class="btn btn-default">Submit</button>
</form>

        
</div><!--/table col-->
</div><!--/Main Row-->
<?php require_once STYLE_DIR."/footer.php" ?> 
