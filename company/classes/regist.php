<?php
class Regist extends Inst{
    //private $method ="aes-256-cbc";
 
    public function hash_pass($password){
        if(!empty($password)){
            $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            return ($hashed_password)?$hashed_password : null;
        }
    }
    
    
    
    public function reg_user($table,$items,$username,$email,$token){ 
    $encrypted_username = self::encode($username); //Encoding Username 
    $result = $this->db->insert($table,$items);
    $sendActCode = self::sendActCode($username,$email,$token,$encrypted_username);//sending a link containing encoded username and token
    if($result) {
    echo Helper::success("Done");
        exit();
    //Helper::redirect("index.php");   
      }
    }
    
    public function activate_user($token){
        if(!empty($token)){   
        $result = $this->db->update("users",array('statusID'=>'1'),"token",$token);
        return ($result)? true : false;
        }else{return false;}
        
    }
    
    private static function sendActCode($username,$email,$token,$encrypted_username){
    
    $subject = "Email Confirmation!";
    $message = "Hi, {$username}.\n\n";
    $message .= "kindly open this link: http://$_SERVER[HTTP_HOST]/act_user.php?u=".$encrypted_username."&token=".$token." to activate your account.\n";
    $headers = "From: auto_sender@echomy.site \r\n";
    mail($email,$subject,$message,$headers);

  } 
    
  public static function mdFive($value){
      if(!empty($value)){
          return md5($value);
      }else{return null;}
  }
    
    private static function encode($value){
      if(!empty($value)){
//          $enckey = openssl_random_pseudo_bytes(32);
//          $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc"));
//          $encrypted = openssl_encrypt($value,"aes-256-cbc",$enckey,0,$iv);
//          $encrypted = $encrypted.":".$iv;
          $encrypted = base64_encode($value);
          return $encrypted;
      }else{return null;}
  } 
    
 public static function decode($encrypted){
          $decrypted = base64_decode($encrypted);
     return $decrypted;
 }
}