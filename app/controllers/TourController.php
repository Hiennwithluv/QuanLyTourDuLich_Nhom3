<?php
class TourController extends Controller {
    private $tourModel;
    private $reviewModel;

    public function __construct() {
        $this->tourModel = $this->model('Tour');
        $this->reviewModel = $this->model('Review');
    }

    // Trang chi tiết Tour
    public function detail($id) {
        $tour = $this->tourModel->getTourById($id);
        if (!$tour) {
            header("Location: " . BASE_URL);
            exit;
        }

        // Lấy danh sách đánh giá từ Model
        $reviews = $this->reviewModel->getReviewsByTour($id);

        $this->view('tour/detail', [
            'title' => $tour->title,
            'tour' => $tour,
            'reviews' => $reviews
        ]);
    }

    // Xử lý khi khách bấm nút "Gửi đánh giá"
    public function postReview() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Bạn cần đăng nhập để thực hiện đánh giá!";
                header("Location: " . BASE_URL . "auth/login");
                exit;
            }

            $tour_id = $_POST['tour_id'];
            $data = [
                'user_id' => $_SESSION['user_id'],
                'tour_id' => $tour_id,
                'rating'  => $_POST['rating'],
                'comment' => htmlspecialchars(trim($_POST['comment']))
            ];

            if ($this->reviewModel->addReview($data)) {
                $_SESSION['success'] = "Cảm ơn bạn đã gửi đánh giá cho tour này!";
            }
            
            // Quay lại trang chi tiết tour vừa đánh giá
            header("Location: " . BASE_URL . "tour/detail/" . $tour_id);
            exit;
        }
    }
}