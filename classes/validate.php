<?php

class Validate extends Inst {
    public $errors = array(),
    $passed = false;
    
 public function validate_input($source,$inputs = array()){
     
     foreach ($inputs as $input=>$rules){
         foreach ($rules as $rule=>$rule_value){
            $value = trim ($source[$input]);
             if ($rule === "required" && empty($value) ){
                 $this->add_error("{$input} is required!");
             }
             
            else if (!empty($value)){
                
                 switch ($rule){
                         
                     case "onlyLetters":
                         if(preg_match('/[^A-Za-z]/',$value)){
                 $this->add_error("{$input} only letters are allowed!");   
                         }break;
                         
                     case "min":
                if (strlen ($value) < $rule_value){
                   $this->add_error("{$input} must be greater than {$rule_value} characters"); 
                } break;        
                                    
                     case "max":
                 if (strlen ($value) > $rule_value){
                   $this->add_error("{$input} must be less than {$rule_value} characters");  }        
                         break;
                         
                     case "positive":
                 if ($value < 1){
                   $this->add_error("{$input} must be positive value");  }        
                         break;      
           }  }         
         } 
     }
     
                  if (empty($this->errors)){
                 $this->ret_passed();
             }
     
 }   

    private function add_error($error){
        
        $this->errors[] = $error;
    }
    
    private function ret_passed(){
         $this->passed = true;
    }
    
    public static function valid_ID($ID){
       if(!empty($ID)&& is_numeric($ID)){
           return true;
       } else return false;
        
    }
    
}