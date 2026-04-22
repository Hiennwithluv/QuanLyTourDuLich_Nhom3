<?php
class BookingController extends Controller {
    public function __construct() {
        if(empty($_SESSION['role']) || $_SESSION['role'] != 'admin') { 
            header("Location: ".BASE_URL); exit; 
        }
    }

    public function index() {
        $bookings = $this->model('Booking')->getAllBookings();
        $this->view('admin/booking/index', ['bookings' => $bookings]);
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['booking_id'];
            $status = $_POST['status'];
            $payment = $_POST['payment_status'];

            if($this->model('Booking')->updateStatus($id, $status, $payment)) {
                $_SESSION['success'] = "Đã cập nhật đơn hàng #$id thành công!";
            }
            header("Location: " . BASE_URL . "admin/booking");
            exit;
        }
    }
}