<?php include '../app/views/layouts/admin_layout.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark mb-1">Dashboard Tổng Quan</h2>
        <p class="text-muted small">Chào mừng bạn trở lại hệ thống quản lý ViVu Tour.</p>
    </div>
    <div class="col-md-6 text-md-end">
        <span class="badge bg-white text-dark shadow-sm py-2 px-3 border">
            <i class="bi bi-calendar3 text-primary me-2"></i><?= date('d/m/Y') ?>
        </span>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="z-1 position-relative">
                    <h6 class="text-white-50 small fw-bold text-uppercase">Doanh thu dự kiến</h6>
                    <h2 class="fw-bold mb-0"><?= number_format($stats['revenue'] ?? 0) ?>đ</h2>
                </div>
                <i class="bi bi-cash-coin position-absolute top-50 end-0 translate-middle-y me-3 opacity-25" style="font-size: 4rem;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-success text-white overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="z-1 position-relative">
                    <h6 class="text-white-50 small fw-bold text-uppercase">Tours Đang Bán</h6>
                    <h2 class="fw-bold mb-0"><?= $stats['tours'] ?? 0 ?> Tour</h2>
                </div>
                <i class="bi bi-geo-fill position-absolute top-50 end-0 translate-middle-y me-3 opacity-25" style="font-size: 4rem;"></i>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 bg-warning text-dark overflow-hidden">
            <div class="card-body p-4 position-relative">
                <div class="z-1 position-relative">
                    <h6 class="text-dark-50 small fw-bold text-uppercase">Đơn chờ duyệt</h6>
                    <h2 class="fw-bold mb-0"><?= $stats['pending'] ?? 0 ?> Đơn</h2>
                </div>
                <i class="bi bi-clock-history position-absolute top-50 end-0 translate-middle-y me-3 opacity-10" style="font-size: 4rem;"></i>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white p-5 text-center border-dashed">
    <div class="py-3">
        <div class="bg-primary bg-opacity-10 text-primary d-inline-flex p-4 rounded-circle mb-4">
            <i class="bi bi-rocket-takeoff fs-1"></i>
        </div>
        <h3 class="fw-bold text-dark">Hệ thống đã sẵn sàng!</h3>
        <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
            Quản lý các tour du lịch của bạn, cập nhật trạng thái đơn hàng của khách hàng hoặc chuyển sang giao diện người dùng để kiểm tra hiển thị.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= BASE_URL ?>admin/tour" class="btn btn-dark btn-lg px-4 fw-bold">Quản lý Tour</a>
            <a href="<?= BASE_URL ?>" class="btn btn-outline-primary btn-lg px-4 fw-bold">Về trang chủ Web</a>
        </div>
    </div>
</div>

            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>