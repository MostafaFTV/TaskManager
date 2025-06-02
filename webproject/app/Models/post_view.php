<?php

class PostView
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // افزودن یا افزایش تعداد بازدید (تست)
    public function addView($post1_id, $post2_id, $count)
    {
        // بررسی وجود قبلی
        $stmt = $this->conn->prepare("SELECT * FROM post_views WHERE post_1_id = ? AND post_2_id = ?");
        $stmt->execute([$post1_id, $post2_id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $stmt = $this->conn->prepare("UPDATE post_views SET views = views + ? WHERE post_1_id = ? AND post_2_id = ?");
            return $stmt->execute([$count, $post1_id, $post2_id]);
        } else {
            $stmt = $this->conn->prepare("INSERT INTO post_views (post_1_id, post_2_id, views) VALUES (?, ?, ?)");
            return $stmt->execute([$post1_id, $post2_id, $count]);
        }
    }

    // گرفتن همه بازدیدها
    public function getAllViews()
    {
        $stmt = $this->conn->prepare("
            SELECT pv.*, p1.title AS from_post, p2.title AS to_post
            FROM post_views pv
            JOIN posts p1 ON pv.post_1_id = p1.id
            JOIN posts p2 ON pv.post_2_id = p2.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
