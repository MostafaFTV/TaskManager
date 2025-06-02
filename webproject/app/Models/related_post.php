<?php

class RelatedPost
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // افزودن یک رابطه بین دو پست
    public function addRelation($post1_id, $post2_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO related_posts (post_1_id, post_2_id) VALUES (?, ?)");
        return $stmt->execute([$post1_id, $post2_id]);
    }

    // گرفتن همه روابط
    public function getAllRelations()
    {
        $stmt = $this->conn->prepare("
            SELECT 
                rp.*, 
                p1.title AS post1_title, 
                p2.title AS post2_title 
            FROM related_posts rp
            JOIN posts p1 ON rp.post_1_id = p1.id
            JOIN posts p2 ON rp.post_2_id = p2.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
