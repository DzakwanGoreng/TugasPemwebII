<?php
require_once 'db.php';

class Post {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createPost($title, $content, $user_id) {
        $query = "INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':title' => $title, ':content' => $content, ':user_id' => $user_id]);
    }

    public function getPosts() {
        $query = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC";
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPost($id) {
        $query = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($id, $title, $content) {
        $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':title' => $title, ':content' => $content, ':id' => $id]);
    }

    public function deletePost($id) {
        $query = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
