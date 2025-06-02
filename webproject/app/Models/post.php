<?php

class Post
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getPostById($post_id, $user_id)
    {
    $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ? AND user_id = ?");
    $stmt->execute([$post_id, $user_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function updatePost($post_id, $user_id, $title, $content)
{
    $stmt = $this->conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?");
    return $stmt->execute([$title, $content, $post_id, $user_id]);
}

    public function deletePost($post_id, $user_id)
    {
    $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
    return $stmt->execute([$post_id, $user_id]);
    }

    public function getPostsByUser($user_id)
    {
      $stmt = $this->conn->prepare("SELECT * FROM posts WHERE user_id = ? ORDER BY createdat DESC");
      $stmt->execute([$user_id]);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // گرفتن همه پست‌ها همراه با نام نویسنده
    public function getAllPosts()
    {
        $stmt = $this->conn->prepare("
            SELECT posts.*, users.name AS author
            FROM posts
            JOIN users ON posts.user_id = users.id
            ORDER BY posts.createdat DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // افزودن پست
    public function addPost($user_id, $title, $content)
    {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $title, $content]);
    }


}
