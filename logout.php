<?php
require_once './class/User.php';
$out = User::logout();
header('Location: login.php'); 
exit;
  
 
   
  
