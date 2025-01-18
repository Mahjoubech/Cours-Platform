<?php
// require_once '.././database/database.php';
require_once 'File.php';
 class User
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $profile_image;
    private $role;
    private $status;

    public function __construct($user_id,$first_name, $last_name, $email, $role,$password,  $profile_image , $status)
    { 
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->role = $role;
        $this->password = $password;
        $this->profile_image = $profile_image;
        $this->status = $status;
    }

    // Getters
    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getFisrtName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getRole(): string
    {
        return $this->role;
    }
    public function getStatus(): string
    {
        return $this->status;
    }

    public function getProfileImage(): ?string
    {
        return $this->profile_image;
    } public function getPassword(){
        return $this->password;
    }
    public function setPassword($password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

   


    public  function save()
    {
        $db = Database::getInstance()->getConnection();
        try {
            
                // Insert new user
                $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, photo,password, role ,status) VALUES (:first_name, :last_name, :email,:photo, :password, :role ,:status)");
                $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);  
                $stmt->bindParam(':first_name', $this->first_name, PDO::PARAM_STR);
                $stmt->bindParam(':last_name',  $this->last_name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
                $stmt->bindParam(':photo', $this->profile_image, PDO::PARAM_STR);
                $stmt->bindParam(':role', $this->role, PDO::PARAM_STR);
                $stmt->bindParam(':status', $this->status, PDO::PARAM_STR);
                $stmt->execute();
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw new Exception("An error occurred while saving the user.");
        }
    }
    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return new User($result['user_id'],$result['first_name'], $result['last_name'], $result['email'],$result['role'], $result['password'],$result['photo'],$result['status']);
        }

        return null;
    }
    public static function signup($firstname, $lastname, $email, $password,$photo,$role,$status,$id=null) {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
    
        // Validate password length
        if (strlen($password) < 6) {
            throw new Exception("Password must be at least 6 characters long");
        }
        //upload image
        if (isset($photo)) {
            $pm = new FileTransfer();
            $path_photo = $pm->uploadPhoto($photo);
        } else {
            throw new Exception( "No file uploaded.");
           
        }
        // Sanitize name fields
        $nom = htmlspecialchars($lastname);
        $prenom = htmlspecialchars($firstname);
    
        // Check if email already exists
        if (self::findByEmail($email)) {
           throw new Exception("Email is already registered");
        }
    
        // Create a new user object
        $user = new User($id,$prenom, $nom, $email, $role ,$password , $path_photo,$status );
        return $user->save();
    }

    public function login($email, $password) {
      return 0;
    }
    public static function logout()
    {
        session_start();
        session_destroy();
        session_unset();
    }
}

// if (isset($_FILES['fileToUpload'])) {
//     var_dump($_FILES['fileToUpload']);
//     $gn = $_FILES['fileToUpload'];
// User :: signup('hhhh','hhhh','hfhuitif@ffbf.com','12314595',$gn,'admin');
//     }
//     // else {
// //     throw new Exception( "No file uploaded.");
// // }
?>

<!-- <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" />
    <input type="submit" name="adds" value="Upload Image" />
</form> -->