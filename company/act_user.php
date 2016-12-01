<?php 
require_once "config.php";
require_once "init.php"; 
require_once STYLE_DIR."/header.php"
?>
<?php
$obj_users = new Users();
$obj_reg = new Regist();
$obj_url = new Url();
if($obj_url->parm_exists("act_code")){
$act_code =$obj_url->get_parm("act_code");
$userInfo = $obj_users->fetchUserBy("act_code",$act_code);
if(!empty($userInfo)){
foreach($userInfo as $user){
$userStatusID = $user['userStatusID'];
}if($userStatusID ==0){
 $active = $obj_reg->activate_user($act_code);
 if($active){
echo Helper::success("Your account has been activated, you can <a href='login.php'>login</a> now!");}
}else{echo Helper::success("Your account is alreay active! you can <a href='login.php'>login</a> now!");}

}else {echo Helper::error("NO DATA FOUND");}}
?>
<?php require_once STYLE_DIR."/footer.php" ?> 