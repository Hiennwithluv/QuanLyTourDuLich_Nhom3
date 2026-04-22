<?php include '../app/views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body p-5">
                    <h2 class="text-center text-primary mb-4 fw-bold">Đăng Ký Tài Khoản</h2>
                    
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form action="<?= BASE_URL ?>auth/register" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Họ và Tên</label>
                            <input type="text" name="name" class="form-control" required placeholder="Nguyễn Văn A">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" required placeholder="0912345678">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Địa chỉ Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="email@example.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted fw-bold">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" required minlength="6">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">TẠO TÀI KHOẢN</button>
                    </form>
                    
                    <div class="text-center mt-4 border-top pt-3">
                        <span class="text-muted">Đã có tài khoản? </span>
                        <a href="<?= BASE_URL ?>auth/login" class="text-decoration-none fw-bold">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../app/views/layouts/footer.php'; ?>