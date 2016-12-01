<?php
class Users extends Inst {
    private function refresh(){
        return header("Refresh:0");
    }
    
    public function fetch_all_users(){
        $sql = "SELECT us.userID AS userID, 
us.username AS username,
us.email AS email,
us.roleID AS userRoleID,
us.statusID AS userStatusID,
st.status AS userStatus,
ro.name AS role
 FROM users us INNER JOIN roles ro ON (us.roleID = ro.roleID)
 INNER JOIN userstatus st ON (us.statusID = st.statusID) WHERE us.roleID <> 1";
        $result = $this->db->fetch_all($sql);
        return ($result) ? $result : false;
    }
    
    
public function fetchUserBy($byName,$byValue){
    
    $sql = "SELECT us.userID AS userID, 
us.username AS username,
us.email AS email,
us.password AS userPassword,
us.roleID AS userRoleID,
us.statusID AS userStatusID,
st.status AS userStatus,
ro.name AS role
 FROM users us INNER JOIN roles ro ON (us.roleID = ro.roleID)
 INNER JOIN userstatus st ON (us.statusID = st.statusID) WHERE {$byName} = '{$byValue}' AND us.roleID <> 1";
    $result = $this->db->fetch_all($sql);
    return ($result) ? $result : false; }
    
  public function fetchUserByForSession($byName,$byValue){
    
    $sql = "SELECT us.userID AS userID, 
us.username AS username,
us.email AS email,
us.password AS userPassword,
us.roleID AS userRoleID,
us.statusID AS userStatusID,
st.status AS userStatus,
ro.name AS role
 FROM users us INNER JOIN roles ro ON (us.roleID = ro.roleID)
 INNER JOIN userstatus st ON (us.statusID = st.statusID) WHERE {$byName} = '{$byValue}'";
    $result = $this->db->fetch_all($sql);
    return ($result) ? $result : false; }  
    
public function fetch_roles(){
    $sql = "SELECT * FROM roles";
    $result = $this->db->fetch_all($sql);
    return ($result) ? $result : false;    
}
 public function fetch_status(){
    $sql = "SELECT * FROM userstatus";
    $result = $this->db->fetch_all($sql);
    return ($result) ? $result : false;    
}   
public function deleUSer($table,$byName,$byValue){   
     $result = $this->db->deleteRow($table,$byName,$byValue);
    if ($result){
return true; } else {return false;}     
}
      public function updateUser($table,$items,$by_name,$userID){
    $result = $this->db->update($table,$items,$by_name,$userID);  
    if ($result){
$this->refresh();
    }
  } 
    
}