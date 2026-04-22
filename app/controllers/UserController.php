<?php
class UserController extends Controller {
    
    public function history() {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để xem lịch sử!";
            header("Location: " . BASE_URL . "auth/login");
            exit;
        }
        
        // Lấy lịch sử đơn hàng của User
        $user_id = $_SESSION['user_id'];
        $bookings = $this->model('Booking')->getBookingsByUser($user_id);
        
        // Gọi giao diện View
        $this->view('user/history', [
            'title' => 'Lịch sử đặt tour',
            'bookings' => $bookings
        ]);
    }
}