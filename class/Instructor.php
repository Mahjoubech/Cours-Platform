<?php
require_once 'User.php';
class instructor extends User{
    public function __construct($user_id ,$first_name, $last_name , $email , $role,$password,  $profile_image , $status){
     parent :: __construct($user_id ,$first_name, $last_name , $email , $role,$password,  $profile_image , $status);
    }
   public static function login($email,$password){
     $user = self::findByEmail($email);
        // var_dump($user->getPassword());
        // var_dump($password);
        if (!$user || !password_verify($password,  $user->getPassword())) {
            throw new Exception("Invalid email or password");
        }

        return $user; 
   }
}