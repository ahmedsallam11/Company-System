<?php 
require_once "config.php"; 
require_once "init.php";
?>
<?php
$input = new Input();
$obj_url = new Url();
$obj_users = new Users();
$userID = $obj_url->get_parm("userID"); 
   if(Input::check()){
    $obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'username'=> array(
        'required'=> true,
        'valUsername'=> true,
        'min'=> 3,
        'max'=>35,
        'editable'=>'users'
    )
    )) ;  
  
   $errors =  $obj_validate->errors;
if($obj_validate->passed){
$updateUser = $obj_users->updateUser("users",array('username'=>$input->get("username"),'roleID'=>$input->get("newRole")),"userID",$userID);

    }else {
  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);
    }   
}     
if(Validate::valid_ID($userID)){       
$users = $obj_users->fetchUserBy("userID",$userID);}    
 if (!empty($users)){
    foreach ($users as $user){
$username = $user['username'];
$userEmail = $user['email'];
$userRole = $user['role']; 
$userRoleID = $user['userRoleID'];
$userstatusID =$user['userStatusID'];
$userstatus =$user['userStatus'];    }
 $roles = $obj_users->fetch_roles();
 $statusArray = $obj_users->fetch_status();      
?>


<h2>Edit User</h2>
<div class="row">
<div class="col-md-7 col-md-offset-1 ">
    <h2 style="text-align:center;color:white;">Sign Up!</h2>
    <form method="post" action="">
      <div class="form-group">
    <label for="username">Username</label>
      <input type="text" onkeyup="valusername()" class="form-control" name="username" id="username" value="<?php echo $username; ?>"><lable id="usernameMessa" for="username"></lable>
  </div>
          <div class="form-group">
    <label for="email">Email</label>
      <input type="text"  class="form-control" name="email" id="email" value="<?php echo $userEmail; ?>" readonly>
  </div> 
<!--
      <div class="form-group">
    <label for="status">Role</label>
    <select name="status" id="status" class="form-control">
<?php 
     //foreach ($statusArray as $status){ 
        //if($status['statusID'] == $userstatusID){ ?> 
        <option value="<?php //echo $userstatusID; ?>" selected><?php //echo $userstatus; ?></option> <?php //}else{ ?> 
        <option value="<?php //echo $status['statusID']; ?>"><?php //echo $status['status']; ?></option>
       <?php //} }?>
    </select>
  </div> 
-->
        
  <div class="form-group">
    <label for="newRole">Role</label>
    <select name="newRole" id="newRole" class="form-control">
<?php 
     foreach ($roles as $role){ 
        if($role['roleID'] == $userRoleID){ ?> 
        <option value="<?php echo $role['roleID']; ?>" selected><?php echo $role['name']; ?></option> <?php }else{ ?> 
        <option value="<?php echo $role['roleID']; ?>"><?php echo $role['name']; ?></option>
       <?php } }?>
    </select>
  </div>
        
    <button type="submit" name="update" class="btn btn-primary">Save</button>     
    </form>
    <?php }else {echo Helper::error("NO DATA FOUND!");} ?>
    </div>    
</div>



