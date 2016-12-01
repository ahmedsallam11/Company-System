<?php 
require_once "config.php"; ?>
<?php
$obj_users = new Users();
$get = new Url();
if($get->parm_exists("delete")){    
$userID = $get->get_parm("delete");
if(Validate::valid_ID($userID)){
$deleteUser= $obj_users->deleUSer("users","userID",$userID);
if($deleteUser){Helper::redirect("?page=users");}    
}}    
$all_users = $obj_users->fetch_all_users(); 
if(!empty($all_users)){ ?>
         <h2 style="position:relative;margin-left:20px;">Welcome to users!</h2>
<div class="row"><!--Main Row-->
    <div class="col-md-7 col-md-offset-1"><!--table col-->

<table class="table  table-bordered">
  <thead>
      <th>N</th> 
      <th>Username</th> 
      <th>Email</th> 
      <th>Role</th>
      <th>Status</th>
      <th>Options</th> 
  </thead>
<tbody>  
<?php     
    
    $n =1;
foreach ($all_users as $user){
echo "<tr>";    
echo "<td>{$n}</td>";    
echo "<td>{$user['username']}</td>";
echo "<td>{$user['email']}</td>";
echo "<td>{$user['role']}</td>";
echo "<td>{$user['userStatus']}</td>";    
echo "<td><a href='?page=edit_user&userID={$user['userID']}'>Edit</a>&nbsp;&nbsp;&nbsp;";
echo "<a href='?page=users&delete={$user['userID']}'>Delete</a></td>";       
echo "</tr>";    
$n++; }?> 
</tbody>      
</table>
<?php } else {echo Helper::error("NO DATA FOUND!");} ?>        
</div><!--/table col-->
</div><!--/Main Row-->
  <?php require_once STYLE_DIR."/footer.php" ?> 


