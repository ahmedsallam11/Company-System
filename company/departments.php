<?php 
require_once "config.php"; ?>

         <h2>Welcome to departments!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1"><!--table col-->
<?php 
$obj_dep = new Departments ();         
$obj_url = new Url();        

if($obj_url->parm_exists("delete")){
 if(Login::roleExists(1)){
 $depID = $obj_url->get_parm("delete");
if(Validate::valid_ID($depID)){
 $deleteEmp = $obj_dep->deleDep("departments","departmentID",$depID);}}else{echo Helper::error("You don't have permession to do this action");}    
}
           
$input = new Input();
   if(Input::check()){
    $obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'departmentName'=> array(
        'required'=> true,
        'min'=> 2,
        'max'=>50,
        'unique'=>'departments',
        'onlyLetters'=>true))) ;  
  
   $errors =  $obj_validate->errors;
    if($obj_validate->passed){
       $add_new = $obj_dep->addNew_dep("departments",array('departmentName'=>$input->get("departmentName")));
}else {
  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);
    }   
}      
?>
<?php if(Login::roleExists(1)){?>      
<form method="post" action="">    
      <div class="form-group">
    <label for="depName">Name</label> &nbsp;&nbsp;<lable id="depMessa" for="depName"></lable> 
    <input type="text" class="form-control" name="departmentName" onkeyup="valdep()" id="depName" value="" style="max-width:200px;">
   <input type="submit" class="btn btn-success" value="Submit">          
  </div>    
    </form><?php } ?>  
<table class="table  table-bordered">            
  <thead>
      <th>N</th> 
      <th>Name</th>
 <?php if(!Login::roleExists(3)){ ?>      
      <th>Options</th><?php } ?>
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
if(!Login::roleExists(3)){    
echo "<td><a href='?page=edit_dep&depID={$dep['departmentID']}'>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<a href='?page=departments&delete={$dep['departmentID']}'>Delete</a></td>";     
echo "</tr>";}   
$n++;    
}    
?> 
</tbody>      
</table>
<?php }else{echo Helper::error("NO DATA FOUND!");} ?>        
</div><!--/table col-->
</div><!--/Main Row-->


  <?php require_once STYLE_DIR."/footer.php" ?>