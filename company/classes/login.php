<?php


class Login extends Inst{
    private $hAdminPages = array('users','edit_user','add_emp','edit_profile'),
    $adminPages = array('edit_dep','edit_emp','edit_sup','departments','ordinary_employees','supervisors','edit_profile'),
    $ordPages = array('departments','ordinary_employees','supervisors','edit_profile');
    
    private static function redirect ($dir){
        return header("Location:{$dir}");
    }
 public static function retBack(){
     return header ('Location: '.($_SERVER['HTTP_REFERER']));
 } 
    public function verif_pass($password,$hash){
    $verified = password_verify($password,$hash);
        if($verified){return true;}else {
            return false;                            
            } }
    
    public static function session($info=array()){
        if(session_status() == PHP_SESSION_NONE){
            session_start();}
        foreach ($info as $user) {
        $_SESSION['userID'] =$user['userID'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['userEmail'] = $user['email'];
        $_SESSION['userRoleID'] =$user['userRoleID'];
        $_SESSION['userRole'] =  $user['role'];   
        $_SESSION['userStatusID'] =$user['userStatusID']; 
        $_SESSION['userStatus'] = $user['userStatus']; } 
        self::redUser();

        
    }
    
    public static function checkSession (){
        if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])){
            return true;
        }else {return false;}}
    
    public static function redUser(){
        if(self::checkSession()){
            self::redirect("index.php");
        }else{self::redirect("login.php");}
    }
     public static function roleExists($num=null){
        if(isset($_SESSION['userID']) && $_SESSION['userRoleID']==$num){
            return true;
        } else {return false;}
     }
    
    public function checkAuth($page){
        if(self::checkSession()){
         if(!empty($page)){    
        switch($_SESSION['userRoleID']){
            case 2:
            if(!in_array($page,$this->adminPages)){self::retBack();}
                break;
            case 3:
            if(!in_array($page,$this->ordPages)){self::retBack();}
                break;}
        }}else{self::redirect("login.php");}
        
    }
         
        }


