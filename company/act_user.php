<?php 
require_once "config.php";
require_once "init.php"; 
require_once STYLE_DIR."/header.php"
?>
<?php
$obj_users = new Users();
$obj_reg = new Regist();
$obj_url = new Url();
if($obj_url->parm_exists("token")&&$obj_url->parm_exists("u")){
$token =$obj_url->get_parm("token");
$decusername =$obj_url->get_parm("u");
$username = Regist::decode($decusername);    
$userExists = $obj_users->fetchUserBy("username",$username);
if(!empty($userExists)){
$userInfo = $obj_users->fetchUserBy("token",$token);
if(!empty($userInfo)){
foreach($userInfo as $user){
$userStatusID = $user['userStatusID'];
}if($userStatusID ==0){
 $active = $obj_reg->activate_user($token);
 if($active){
echo Helper::success("Your account has been activated, you can <a href='login.php'>login</a> now!");}else {echo Helper::error("An error has occured!");}
}else{echo Helper::success("Your account is alreay active! you can <a href='login.php'>login</a> now!");}

}else {echo Helper::error("An error has occured!");}}else {echo Helper::error("NO DATA FOUND");}}
else {echo Helper::error("NO DATA FOUND");}
?>
<?php require_once STYLE_DIR."/footer.php" ?> 