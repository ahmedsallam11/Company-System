<?php
class Regist extends Inst{
    
    
    public function encrypt_pass($password){
        if(!empty($password)){
            $encrypted_password = password_hash($password,PASSWORD_DEFAULT);
            return ($encrypted_password)?$encrypted_password : null;
        }
    }
    
    
    
    public function reg_user($table,$items,$username,$email,$key){    
    $result = $this->db->insert($table,$items);
    $sendActCode = self::sendActCode($username,$email,$key);
    if($result) {
    Helper::redirect("index.php");   
      }
    }
    
    public function activate_user($act_code){
        if(!empty($act_code)){   
        $result = $this->db->update("users",array('statusID'=>'1'),"act_code",$act_code);
        return ($result)? true : false;
        }else{return false;}
        
    }
    
    private static function sendActCode($username,$email,$key){
    
  $subject = "Email Confirmation";
  $to_fullname = $username;
    $to_email = $email;
  $from_email = "auto_sender@echomy.site";
  $from_fullname = "Company";
  $headers  = "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=utf-8\r\n";
  $headers .= "To: $to_fullname <$to_email>\r\n";
  $headers .= "From: $from_fullname <$from_email>\r\n";
  $message = "Hi, {$to_fullname} ";
  $message .= "kindly open this link: http://$_SERVER[HTTP_HOST]/act_user.php?act_code={$key} to activate your account.";
  $sending = mail($to_email, $subject, $message, $headers);
  if ($sending) { 
    print_r(error_get_last());
  }
  
  } 
    
    public static function genActCode(){
        return $key = md5(microtime().rand());

    }
}