<?php
session_start();
session_unset();
session_destroy();
$_SESSION = array();
if(!isset($_SESSION['userID'])){
header ("Location: login.php");
exit();
}
