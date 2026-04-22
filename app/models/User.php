<?php
class User {
    private $db;
    public function __construct() { $this->db = Database::getInstance(); }
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]); return $stmt->fetch();
    }
    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password, phone, role) VALUES (:name, :email, :password, :phone, 'user')");
        return $stmt->execute($data);
    }
}
?>