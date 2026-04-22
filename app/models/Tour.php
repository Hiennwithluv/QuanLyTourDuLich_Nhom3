<?php
class Tour {
    private $db;

    public function __construct() { 
        // Kết nối cơ sở dữ liệu thông qua Singleton pattern
        $this->db = Database::getInstance(); 
    }

    // --- 1. CÁC HÀM TRUY XUẤT DỮ LIỆU (READ) ---

    // Lấy 6 tour nổi bật để hiện ở trang chủ
    public function getFeaturedTours() {
        return $this->db->query("SELECT * FROM tours WHERE status='active' AND is_featured=1 LIMIT 6")->fetchAll();
    }
    
    // Lấy toàn bộ danh sách tour (Dùng cho trang quản lý admin)
    public function getAllTours() {
        return $this->db->query("SELECT * FROM tours ORDER BY created_at DESC")->fetchAll();
    }
    
    // Lấy thông tin chi tiết của 1 tour dựa trên ID
    public function getTourById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tours WHERE id = ?");
        $stmt->execute([$id]); 
        return $stmt->fetch();
    }

    // --- 2. HÀM TÌM KIẾM VÀ LỌC NÂNG CAO (SEARCH & FILTER) ---

    public function searchTours($keyword = '', $min_price = 0, $max_price = 999999999999) {
        $sql = "SELECT * FROM tours 
                WHERE status='active' 
                AND (title LIKE :kw OR location LIKE :kw) 
                AND price >= :min_p 
                AND price <= :max_p 
                ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'kw' => "%$keyword%",
            'min_p' => (float)$min_price,
            'max_p' => (float)$max_price
        ]);
        return $stmt->fetchAll();
    }

    // --- 3. CÁC HÀM THAY ĐỔI DỮ LIỆU (C.U.D) ---

    // Thêm tour mới vào hệ thống
    public function createTour($data) {
        $sql = "INSERT INTO tours (title, description, price, duration, location, image_url, is_featured, status) 
                VALUES (:title, :description, :price, :duration, :location, :image_url, :is_featured, :status)";
        $stmt = $this->db->prepare($sql);
        
        // Ép kiểu dữ liệu để đảm bảo an toàn cho MySQL
        $data['price'] = (float)$data['price'];
        $data['duration'] = (int)$data['duration'];
        $data['is_featured'] = (int)$data['is_featured'];
        
        return $stmt->execute($data);
    }

    // Cập nhật thông tin tour đã tồn tại
    public function updateTour($data) {
        $sql = "UPDATE tours SET 
                title = :title, 
                description = :description, 
                price = :price, 
                duration = :duration, 
                location = :location, 
                image_url = :image_url, 
                is_featured = :is_featured, 
                status = :status 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        $data['price'] = (float)$data['price'];
        $data['duration'] = (int)$data['duration'];
        $data['is_featured'] = (int)$data['is_featured'];
        
        return $stmt->execute($data);
    }

    // Xóa vĩnh viễn 1 tour khỏi hệ thống
    public function deleteTour($id) {
        $stmt = $this->db->prepare("DELETE FROM tours WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>