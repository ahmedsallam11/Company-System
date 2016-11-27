<?php 
require_once "config.php"; 
?>

         <h2>Edit Employee!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1 "><!--table col-->

<?php  
 $obj_url = new Url(); 
 $depID = $obj_url->get_parm("depID");       
$obj_dep = new Departments();         
   if(Input::check()){
$input = new Input();       
$obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'depName'=> array(
        'required'=> true,
        'min'=> 2,
        'max'=>50,
        'onlyLetters'=>true
    ))) ;  
  
   $errors =  $obj_validate->errors;
    if($obj_validate->passed){
$updateQ = $obj_dep->update_dep("departments",array('departmentName'=>$input->get("depName")),"departmentID",$depID);      if($updateQ){Helper::refresh();}  
 } else {   
 $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);}}      
       
if($obj_url->parm_exists("depID")){       
if(Validate::valid_ID($depID)){ 
  $depArray = $obj_dep->fetchDepbyID($depID); }}
if(!empty($depArray)) {  
 foreach ($depArray as $dep){
     $depName = $dep['departmentName'];
 } 
?>     
    <form method="post" action="">    
  <div class="form-group">
    <label for="depName">Name</label> &nbsp;&nbsp;<lable id="depMessa" for="depName"></lable>
    <input type="text" class="form-control" name="depName" onkeyup="valdep()" id="depName" value="<?php echo $depName;?>">
  
  </div>
    
  <button type="submit" name="update" class="btn btn-success">Update</button>
</form><?php } else{
        echo Helper::error("NO DATA FOUND");}
        ?>

        
</div><!--/table col-->
</div><!--/Main Row-->
<?php require_once STYLE_DIR."/footer.php" ?> 
