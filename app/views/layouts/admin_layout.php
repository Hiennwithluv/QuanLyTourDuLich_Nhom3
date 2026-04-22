<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Hệ thống Quản trị - ViVu Tour' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .sidebar { min-width: 260px; max-width: 260px; min-height: 100vh; position: sticky; top: 0; }
        .nav-link { color: rgba(255,255,255,0.8); transition: all 0.3s; padding: 12px 20px; }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,0.1); border-radius: 8px; }
        .nav-link.active { background: #0d6efd; color: #fff; border-radius: 8px; fw-bold; }
        .main-content { background-color: #f8f9fa; flex-grow: 1; }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark text-white p-3 shadow-lg">
            <div class="text-center mb-4 pt-3">
                <h4 class="text-primary fw-bold mb-0"><i class="bi bi-shield-lock-fill"></i> ADMIN PANEL</h4>
                <hr class="text-secondary mx-3">
            </div>
            
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>admin/dashboard" class="nav-link">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>admin/tour" class="nav-link">
                        <i class="bi bi-map me-2"></i> Quản lý Tour
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>admin/booking" class="nav-link">
                        <i class="bi bi-cart-check me-2"></i> Quản lý Đơn hàng
                    </a>
                </li>

                <div class="mt-4 mb-2 ps-3 small text-uppercase text-muted fw-bold" style="font-size: 0.7rem;">Hệ thống</div>
                
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>" class="nav-link text-info fw-bold">
                        <i class="bi bi-house-door-fill me-2"></i> QUAY LẠI WEBSITE
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>auth/logout" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>

        <div class="main-content">
            <nav class="navbar navbar-expand bg-white border-bottom p-3 mb-4 shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-text fw-bold text-dark fs-5">
                        <i class="bi bi-person-circle text-primary me-1"></i> Admin: <?= htmlspecialchars($_SESSION['name']) ?>
                    </span>
                    <div class="ms-auto d-flex align-items-center">
                        <a href="<?= BASE_URL ?>" class="btn btn-outline-primary fw-bold me-2">
                            <i class="bi bi-eye me-1"></i> Xem trang chủ
                        </a>
                        <span class="badge bg-success py-2 px-3 rounded-pill">Online</span>
                    </div>
                </div>
            </nav>
            
            <div class="px-4 pb-5">