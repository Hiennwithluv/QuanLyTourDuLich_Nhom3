<?php include '../app/views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h2 class="text-center text-primary mb-4 fw-bold">Đăng Nhập</h2>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>auth/login" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Địa chỉ Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" required placeholder="nguyenvana@gmail.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted fw-bold">Mật khẩu</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">ĐĂNG NHẬP</button>
                    </form>
                    
                    <div class="text-center mt-4 border-top pt-3">
                        <span class="text-muted">Chưa có tài khoản? </span>
                        <a href="<?= BASE_URL ?>auth/register" class="text-decoration-none fw-bold">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../app/views/layouts/footer.php'; ?>