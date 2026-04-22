<?php
class DashboardController extends Controller {
    public function index() {
        if(empty($_SESSION['role']) || $_SESSION['role'] != 'admin') { header("Location: ".BASE_URL); exit; }
        $stats = $this->model('Booking')->getStats();
        $this->view('admin/dashboard', ['stats' => $stats]);
    }
}