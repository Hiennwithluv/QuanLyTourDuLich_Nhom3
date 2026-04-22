<?php
class Booking {
    private $db;

    public function __construct() { 
        $this->db = Database::getInstance(); 
    }
    
    // --- 1. DÀNH CHO KHÁCH HÀNG (USER) --- //

    // User đặt tour mới
    public function createBooking($data) {
        $sql = "INSERT INTO bookings (user_id, tour_id, booking_date, num_people, total_price, status, payment_status) 
                VALUES (:user_id, :tour_id, :booking_date, :num_people, :total_price, 'pending', 'unpaid')";
        return $this->db->prepare($sql)->execute($data);
    }
    
    // User xem lịch sử đặt của mình
    public function getBookingsByUser($user_id) {
        $stmt = $this->db->prepare("SELECT b.*, t.title as tour_title, t.image_url 
                                    FROM bookings b 
                                    JOIN tours t ON b.tour_id = t.id 
                                    WHERE b.user_id = ? 
                                    ORDER BY b.created_at DESC");
        $stmt->execute([$user_id]); 
        return $stmt->fetchAll();
    }
    
    // --- 2. DÀNH CHO QUẢN TRỊ VIÊN (ADMIN) --- //

    // Lấy 3 con số thống kê cho trang Dashboard
    public function getStats() {
        return [
            'revenue' => $this->db->query("SELECT SUM(total_price) FROM bookings WHERE status='completed'")->fetchColumn() ?: 0,
            'tours' => $this->db->query("SELECT COUNT(*) FROM tours")->fetchColumn(),
            'pending' => $this->db->query("SELECT COUNT(*) FROM bookings WHERE status='pending'")->fetchColumn()
        ];
    }

    // Lấy TẤT CẢ đơn hàng của hệ thống để quản lý
    public function getAllBookings() {
        $sql = "SELECT b.*, u.name as user_name, t.title as tour_title 
                FROM bookings b 
                JOIN users u ON b.user_id = u.id 
                JOIN tours t ON b.tour_id = t.id 
                ORDER BY b.created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    // Cập nhật trạng thái đơn (Đã duyệt, Đã hủy, Đã thanh toán...)
    public function updateStatus($id, $status, $payment_status) {
        $sql = "UPDATE bookings SET status = :status, payment_status = :payment_status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'status' => $status, 
            'payment_status' => $payment_status, 
            'id' => $id
        ]);
    }
}
?>