<?php
class AuthController extends Controller {
    
    // 1. Chức năng Đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $this->model('User')->getUserByEmail($_POST['email']);
            
            if ($user && password_verify($_POST['password'], $user->password)) {
                $_SESSION['user_id'] = $user->id; 
                $_SESSION['name'] = $user->name; 
                $_SESSION['role'] = $user->role;
                
                header("Location: " . BASE_URL . ($user->role == 'admin' ? "admin/dashboard" : "")); 
                exit;
            }
            $this->view('auth/login', ['error' => 'Sai tài khoản hoặc mật khẩu!']); 
            return;
        }
        $this->view('auth/login');
    }

    // 2. Chức năng Đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $phone = trim($_POST['phone']);

            // Kiểm tra xem email đã tồn tại trong DB chưa
            if ($this->model('User')->getUserByEmail($email)) {
                $this->view('auth/register', ['error' => 'Email này đã được sử dụng!']);
                return;
            }

            // Băm mật khẩu để bảo mật
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $hashed_password,
                'phone' => $phone
            ];

            // Lưu vào Database
            if ($this->model('User')->createUser($data)) {
                $_SESSION['success'] = "Đăng ký thành công. Vui lòng đăng nhập!";
                header("Location: " . BASE_URL . "auth/login");
                exit;
            }
        }
        $this->view('auth/register');
    }

    // 3. Chức năng Đăng xuất
    public function logout() { 
        session_destroy(); 
        header("Location: " . BASE_URL); 
        exit;
    }
}
?>