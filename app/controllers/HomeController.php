<?php
class HomeController extends Controller {
    public function index() {
        $tourModel = $this->model('Tour');
        
        // 1. Lấy từ khóa và giá tối đa từ URL (phương thức GET)
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';

        // 2. Kiểm tra nếu người dùng đang thực hiện Tìm kiếm hoặc Lọc
        if (!empty($keyword) || !empty($max_price)) {
            // Nếu không nhập giá, mặc định là một con số rất lớn
            $limit_price = !empty($max_price) ? (float)$max_price : 999999999999;
            $tours = $tourModel->searchTours($keyword, 0, $limit_price);
            $title = "Kết quả tìm kiếm cho: " . ($keyword ?: "Mọi địa điểm");
        } else {
            // 3. Nếu vào trang chủ bình thường, lấy các Tour nổi bật (Featured)
            $tours = $tourModel->getFeaturedTours();
            $title = "Trang chủ - ViVu Tour";
        }

        // 4. Trả dữ liệu ra View
        $this->view('home/index', [
            'title' => $title,
            'tours' => $tours,
            'keyword' => $keyword,
            'max_price' => $max_price
        ]);
    }
}