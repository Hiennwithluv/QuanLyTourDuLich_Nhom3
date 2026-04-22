<?php
class Review {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Lấy tất cả đánh giá của 1 tour kèm theo tên người dùng
    public function getReviewsByTour($tour_id) {
        $sql = "SELECT r.*, u.name 
                FROM reviews r 
                JOIN users u ON r.user_id = u.id 
                WHERE r.tour_id = :tour_id 
                ORDER BY r.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['tour_id' => $tour_id]);
        return $stmt->fetchAll();
    }

    // Lưu đánh giá mới vào Database
    public function addReview($data) {
        $sql = "INSERT INTO reviews (user_id, tour_id, rating, comment) 
                VALUES (:user_id, :tour_id, :rating, :comment)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }
}