<?php
class Admin {
    private $id;
    private $name;
    private static $db;
    private $categories = []; 
    private $tags = [];
    public static function setDb() {
        self::$db = Database::getInstance()->getConnection();
    }
    public function __construct($id , $name ) {
        $this->id = $id;
        $this->name = $name;
    }
   function getId(){
    return $this->id;
   }
   function getName(){
    return $this->name;
   }

   //CATEGORYS
    public function addCategory($name) {
        $category = new Category(null, $name);
        if ($category->add()) {
            $this->categories[] = $category; 
            return true;
        }
        return false;
    }


    public function updateCategory($id, $newName) {

        foreach ($this->categories as $category) {
            if ($category->id === $id) {
                $category->name = $newName;
                return $category->update();
            }
        }
        $category = new Category($id, $newName);
        return $category->update();
    }


    public function deleteCategory($id) {
        foreach ($this->categories as $key => $category) {
            if ($category->id === $id) {
                unset($this->categories[$key]); 
             return $category->delete();
    }
    $category = new Category($id);
     return $category->delete();
    }
  }


    public function loadCategories() {
        $this->categories = [];
        $data = Category::getAll();
        foreach ($data as $item) {
            $this->categories[] = new Category($item['id'], $item['name']);
        }
    }

    public function displayCategories() {
        return $this->categories ;
        
    }
 // TAGS
    public function addTag($name) {
        $tag = new Tags(null, $name);
        if ($tag->add()) {
            $this->tags[] = $tag; 
            return true;
        }
        return false;
    }


    public function updateTag($id, $newName) {

        foreach ($this->tags as $tag) {
            if ($tag->id === $id) {
                $tag->name = $newName;
                return $tag->update();
            }
        }
        $tag = new Tags($id, $newName);
        return $tag->update();
    }


    public function deleteTag($id) {
        foreach ($this->tags as $key => $tag) {
            if ($tag->id === $id) {
                unset($this->tags[$key]); 
             return $tag->delete();
    }
    $tag = new Tags($id);
     return $tag->delete();
    }
  }


    public function loadTags() {
        $this->tags = [];
        $data = Tags::getAll();
        foreach ($data as $item) {
            $this->tags[] = new Tags($item['id'], $item['name']);
        }
    }

    public function displayTags() {
        return $this->tags ;
        
    }
    public function getAllUsers(){
        self::setDb(); 
        $sql =  "SELECT * FROM users ";
        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getInstrStatus($status){
        self::setDb(); 
        $stmt = self::$db->prepare("SELECT * FROM users WHERE status = :status");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return  $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateInstrStatus($userId, $newStatus) {
        self::setDb(); 
        $sql = "UPDATE users SET status = :status WHERE user_id = :user_id"; 
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function countInstrStatus($status) {
        self::setDb(); 
        $stmt = self::$db->prepare("SELECT COUNT(*) FROM users WHERE status = :status AND role = 'instructor'");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getAllUsersRole($role){
        self::setDb(); 
        $stmt = self::$db->prepare("SELECT * FROM users WHERE (status = 'susspend' or status = 'active') AND role = :role");
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}


   
   
// $dd = new Admin(1,'admin');
// $dd->deleteCategory(22);
// var_dump($dd->getInstrStatus('pandding'));

