<?php 
require_once "config.php"; ?>

         <h2>Welcome to departments!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1"><!--table col-->
<?php 
$obj_dep = new Departments ();         
$obj_url = new Url();        

if($obj_url->parm_exists("dele")){
 $depID = $obj_url->get_parm("dele");
if(Validate::valid_ID($depID)){
 $deleteEmp = $obj_dep->deleDep("departments","departmentID",$depID);}    
}
           
$input = new Input();
   if(Input::check()){
    $obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'depName'=> array(
        'required'=> true,
        'min'=> 2,
        'max'=>50,
        'onlyLetters'=>true))) ;  
  
   $errors =  $obj_validate->errors;
    if($obj_validate->passed){
       $add_new = $obj_dep->addNew_dep("departments",array('departmentName'=>$input->get("depName")));
}else {
  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);
    }   
}      
?>
        
<form method="post" action="">    
      <div class="form-group">
    <label for="depName">Name</label> &nbsp;&nbsp;<lable id="depMessa" for="depName"></lable> 
    <input type="text" class="form-control" name="depName" onkeyup="valdep()" id="depName" value="" style="max-width:200px;">
   <input type="submit" class="btn btn-success" value="Submit">          
  </div>    
    </form>
        
<table class="table  table-bordered">            
  <thead>
      <th>N</th> 
      <th>Name</th>
      <th>Options</th> 
  </thead>
<tbody>  
<?php
$all_dep = $obj_dep->fetch_all_departments();
if(!empty($all_dep)){    
    $n =1;
foreach ($all_dep as $dep){
echo "<tr>";    
echo "<td>{$n}</td>";    
echo "<td>{$dep['departmentName']}</td>";
echo "<td><a href='?page=edit_dep&depID={$dep['departmentID']}'>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='?page=departments&dele={$dep['departmentID']}'>Delete</a></td>";     
echo "</tr>";    
$n++;    
}    
?> 
</tbody>      
</table>
<?php }else{echo Helper::error("NO DATA FOUND!");} ?>        
</div><!--/table col-->
</div><!--/Main Row-->


  <?php require_once STYLE_DIR."/footer.php" ?>