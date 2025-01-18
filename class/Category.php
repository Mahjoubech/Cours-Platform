<?php

class Category {
    private static $db;
    public $id;
    public $name;

    public static function setDb() {
        self::$db = Database::getInstance()->getConnection();
    }
    
    public function __construct($id = null, $name = null) {
        $this->id = $id;
        $this->name = $name;
    }

    public function add() {
        self::setDb();  
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        return $stmt->execute();
    }

    public function update() {
        self::setDb();  
        $sql = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    public function delete() {
        self::setDb();  
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

   
    public static function getAll() {
        self::setDb();  
        $sql = "SELECT * FROM categories";
        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $ff = new Category();

// var_dump($ff->delete());