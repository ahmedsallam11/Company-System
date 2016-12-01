<?php 
require_once "config.php"; 
require_once "init.php";
?>
<?php require_once STYLE_DIR."/header.php" ?>
<?php
$input = new Input();
   if(Input::check()){
    $obj_validate = new Validate();
    $val = $obj_validate->validate_input($_POST,array(
    'username'=> array(
        'required'=> true,
        'valUsername'=> true,
        'min'=> 4,
        'max'=>50,
        'unique'=>'users'
    ),
    'email'=> array(
        'required'=> true,
        'min'=> 6,
        'validEmail'=>true,
        'unique'=>'users'
    ),    
    'password'=> array(
        'required'=> true,
        'min'=> 6,
        'lettersNum'=> true
    ),
        'passAgain'=> array(
        'required'=> true,
        'min'=> 6,
        'lettersNum'=> true,
         'matches'=>'password'
    ) 
    )) ;  
  
   $errors =  $obj_validate->errors;
    if($obj_validate->passed){
        $obj_regist = new Regist();
        $encrypted_password = $obj_regist->encrypt_pass($input->get("password"));
        $ActKey =Regist::genActCode();
        $regUser = $obj_regist->reg_user("users",array('username'=>$input->get("username"),'email'=>$input->get("email"),'password'=>$encrypted_password,'act_code'=>$ActKey),$input->get("username"),$input->get("email"),$ActKey);

    }else {
  $err_list = implode("<br>",$errors); 
  echo Helper::error($err_list);
    }   
}     
    
    
?>


<div class="container">
<div class="row">
<div class="col-md-6 col-md-offset-3 regForm">
    <h2 style="text-align:center;color:white;">Sign Up!</h2>
    <form method="post" action="">
      <div class="form-group">
    <label for="username">Username</label>
      <input type="text" onkeyup="valusername()" class="form-control" name="username" id="username" value=""><lable id="usernameMessa" for="username"></lable>
  </div>
        
  <div class="form-group">
    <label for="email">Email address <small>(You will receive an activation message on it)</small></label>
    <input type="email" class="form-control" onkeyup="valemail()" name="email" id="email" value=""><lable id="emailMessa" for="email"></lable>
  </div>
        
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" onkeyup="valpassword()" name="password" id="password" value=""><lable id="passwordMessa" for="password"></lable>
  </div>
        
  <div class="form-group">
    <label for="passAgain">Password again</label>
    <input type="password" class="form-control" onkeyup="valpassAgain()" name="passAgain" id="passAgain" value=""><lable id="passAgainMessa" for="passAgain"></lable>
  </div>
    <button type="submit" name="update" class="btn btn-default">Sign Up</button>&nbsp;&nbsp;<a href="login.php" style="color:green;">Or Login!</a>      
    </form>
    
    </div>    
</div>
</div>


<?php require_once STYLE_DIR."/footer.php" ?> 