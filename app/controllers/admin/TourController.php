<?php
class TourController extends Controller {
    public function __construct() {
        // Chặn quyền tất cả các hàm trong Controller này
        if(empty($_SESSION['role']) || $_SESSION['role'] != 'admin') { 
            header("Location: ".BASE_URL); 
            exit; 
        }
    }

    // 1. Hiển thị danh sách
    public function index() {
        $tours = $this->model('Tour')->getAllTours();
        $this->view('admin/tour/index', ['tours' => $tours]);
    }

    // 2. Gọi giao diện Thêm mới
    public function create() {
        $this->view('admin/tour/create');
    }

    // 3. Xử lý lưu Tour mới vào DB
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image_url = null;
            // Xử lý upload ảnh
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_url = time() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], '../public/assets/uploads/' . $image_url);
            }

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => $_POST['price'],
                'duration' => $_POST['duration'],
                'location' => trim($_POST['location']),
                'image_url' => $image_url,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'status' => $_POST['status']
            ];

            $this->model('Tour')->createTour($data);
            $_SESSION['success'] = "Thêm Tour mới thành công!";
            header("Location: " . BASE_URL . "admin/tour");
            exit;
        }
    }

    // 4. Gọi giao diện Sửa (kèm dữ liệu cũ)
    public function edit($id) {
        $tour = $this->model('Tour')->getTourById($id);
        if (!$tour) {
            header("Location: " . BASE_URL . "admin/tour");
            exit;
        }
        $this->view('admin/tour/edit', ['tour' => $tour]);
    }

    // 5. Xử lý cập nhật Tour vào DB
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tour = $this->model('Tour')->getTourById($id);
            $image_url = $tour->image_url; // Mặc định giữ ảnh cũ

            // Nếu người dùng chọn upload ảnh mới
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_url = time() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], '../public/assets/uploads/' . $image_url);
            }

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => $_POST['price'],
                'duration' => $_POST['duration'],
                'location' => trim($_POST['location']),
                'image_url' => $image_url,
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
                'status' => $_POST['status']
            ];

            $this->model('Tour')->updateTour($data);
            $_SESSION['success'] = "Cập nhật Tour thành công!";
            header("Location: " . BASE_URL . "admin/tour");
            exit;
        }
    }

    // 6. Xóa Tour
    public function delete($id) {
        $this->model('Tour')->deleteTour($id);
        $_SESSION['success'] = "Đã xóa tour thành công!";
        header("Location: " . BASE_URL . "admin/tour");
        exit;
    }
}
?>