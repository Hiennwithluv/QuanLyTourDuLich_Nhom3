<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'ViVu Tour' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="<?= BASE_URL ?>">ViVu Tour</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>">Trang chủ</a></li>
                
                <?php $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                <li class="nav-item me-3 ms-2">
                    <a class="nav-link text-warning fw-bold" href="<?= BASE_URL ?>cart/index">
                        <i class="bi bi-cart3 fs-5"></i> Giỏ hàng
                        <?php if($cartCount > 0): ?>
                            <span class="badge bg-danger rounded-pill pb-1"><?= $cartCount ?></span>
                        <?php endif; ?>
                    </a>
                </li>

                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if($_SESSION['role']=='admin'): ?>
                        <li class="nav-item"><a class="nav-link text-info fw-bold" href="<?= BASE_URL ?>admin/dashboard">Admin Panel</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>user/history">Lịch sử đặt</a></li>
                    <?php endif; ?>
                    <li class="nav-item ms-2">
                        <a class="btn btn-sm btn-outline-light text-danger bg-white border-0 fw-bold" href="<?= BASE_URL ?>auth/logout">Đăng xuất (<?= htmlspecialchars($_SESSION['name']) ?>)</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>auth/login">Đăng nhập</a></li>
                    <li class="nav-item"><a class="btn btn-sm btn-light text-primary fw-bold ms-2" href="<?= BASE_URL ?>auth/register">Đăng ký</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>