<?php
class CartController extends Controller {
    
    // 1. Hiển thị trang Giỏ hàng
    public function index() {
        $cartItems = [];
        $totalCartPrice = 0;

        // Nếu có giỏ hàng, lấy thông tin chi tiết từng tour từ DB
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $tourModel = $this->model('Tour');
            foreach ($_SESSION['cart'] as $tour_id => $item) {
                $tour = $tourModel->getTourById($tour_id);
                if ($tour) {
                    $itemTotalPrice = $tour->price * $item['num_people'];
                    $totalCartPrice += $itemTotalPrice;
                    
                    $cartItems[] = [
                        'tour' => $tour,
                        'num_people' => $item['num_people'],
                        'booking_date' => $item['booking_date'],
                        'item_total' => $itemTotalPrice
                    ];
                }
            }
        }

        $this->view('cart/index', [
            'title' => 'Giỏ hàng của bạn',
            'cartItems' => $cartItems,
            'totalCartPrice' => $totalCartPrice
        ]);
    }

    // 2. Thêm Tour vào Giỏ hàng
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour_id = $_POST['tour_id'];
            $num_people = (int)$_POST['num_people'];
            $booking_date = $_POST['booking_date'];

            // Khởi tạo giỏ hàng nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Nếu tour đã có trong giỏ, cập nhật số lượng. Nếu chưa, thêm mới.
            if (isset($_SESSION['cart'][$tour_id])) {
                $_SESSION['cart'][$tour_id]['num_people'] += $num_people;
                // Có thể cập nhật lại ngày đi nếu muốn: $_SESSION['cart'][$tour_id]['booking_date'] = $booking_date;
            } else {
                $_SESSION['cart'][$tour_id] = [
                    'num_people' => $num_people,
                    'booking_date' => $booking_date
                ];
            }

            $_SESSION['success'] = "Đã thêm tour vào giỏ hàng!";
            header("Location: " . BASE_URL . "cart/index");
            exit;
        }
    }

    // 3. Xóa Tour khỏi Giỏ hàng
    public function remove($tour_id) {
        if (isset($_SESSION['cart'][$tour_id])) {
            unset($_SESSION['cart'][$tour_id]);
            $_SESSION['success'] = "Đã xóa tour khỏi giỏ hàng!";
        }
        header("Location: " . BASE_URL . "cart/index");
        exit;
    }

    // 4. Thanh toán (Checkout) toàn bộ Giỏ hàng
    public function checkout() {
        // Bắt buộc đăng nhập mới được thanh toán
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vui lòng đăng nhập để thanh toán!";
            header("Location: " . BASE_URL . "auth/login");
            exit;
        }

        if (empty($_SESSION['cart'])) {
            header("Location: " . BASE_URL . "cart/index");
            exit;
        }

        $bookingModel = $this->model('Booking');
        $tourModel = $this->model('Tour');
        $user_id = $_SESSION['user_id'];

        // Lặp qua từng sản phẩm trong giỏ và Insert vào bảng bookings
        foreach ($_SESSION['cart'] as $tour_id => $item) {
            $tour = $tourModel->getTourById($tour_id);
            if ($tour) {
                $total_price = $tour->price * $item['num_people'];
                
                $data = [
                    'user_id' => $user_id,
                    'tour_id' => $tour_id,
                    'booking_date' => $item['booking_date'],
                    'num_people' => $item['num_people'],
                    'total_price' => $total_price
                ];
                
                $bookingModel->createBooking($data);
            }
        }

        // Đặt hàng xong thì xóa giỏ hàng
        unset($_SESSION['cart']);
        $_SESSION['success'] = "Thanh toán thành công! Vui lòng chờ admin xác nhận các tour của bạn.";
        header("Location: " . BASE_URL . "user/history");
        exit;
    }
}
?>