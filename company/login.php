<?php 

require_once "config.php"; 
require_once "init.php";
?>
<?php require_once STYLE_DIR."/header.php" ?>
<?php
$obj_login = new Login (); 
$obj_users = new Users();
 $obj_validate = new Validate();
$input = new Input();
   if(Input::check()){
 $val = $obj_validate->validate_input($_POST,array(
    'username'=> array(
        'required'=> true,
        'exists'=>'users'),
     'password'=> array(
        'required'=> true)
 ));
      $errors =  $obj_validate->errors;
    if($obj_validate->passed){
     $loginUsernaeme = $input->get("username");
    $loginPass = $input->get("password");   
 
       $userInfo = $obj_users->fetchUserByForSession("username",$loginUsernaeme);
       foreach ($userInfo as $info){
        $userEmail = $info['email'];   
        $userPassword = $info['userPassword'];
        $userStatus = $info['userStatusID'];}
       $verified_pass = $obj_login->verif_pass($loginPass,$userPassword);
       if($verified_pass){
        if($userStatus ==1){   
       $session = Login::session($userInfo);}else{
        echo Helper::error("Your account is not active. a message has been sent to your email: {$userEmail} to activate your account!");}
       }else{echo Helper::error("Wrong password!");}
}else{  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);}

    
   }
?>


<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3 regForm">
    <h2 style="text-align:center;color:white;">Login!</h2>
    <form method="post" action="">
      <div class="form-group">
    <label for="loginusername">Username</label>&nbsp;&nbsp;<label></label>
      <input type="text" class="form-control" name="username" id="loginusername" value="">
  </div>    
  <div class="form-group">
    <label for="loginPass">Password</label>&nbsp;&nbsp;<label></label>
    <input type="password" class="form-control" name="password" id="loginPass" value="">
  </div>

    <button type="submit" name="update" class="btn btn-default">Login</button>&nbsp;&nbsp;<a href="" style="color:white;">Forgot your password?</a>&nbsp;&nbsp;<a href="signup.php" style="color:green;">Or sign up!</a>   
    </form>
    
    </div>    
</div>
</div>


<?php require_once STYLE_DIR."/footer.php" ?> 