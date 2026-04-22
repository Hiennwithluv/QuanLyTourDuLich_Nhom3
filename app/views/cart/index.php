<?php include '../app/views/layouts/header.php'; ?>

<div class="container mt-5" style="min-height: 60vh;">
    <div class="d-flex align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0"><i class="bi bi-cart3"></i> Giỏ hàng của bạn</h2>
    </div>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(!empty($cartItems)): ?>
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Thông tin Tour</th>
                                        <th>Lịch trình</th>
                                        <th>Thành tiền</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cartItems as $item): ?>
                                    <tr>
                                        <td class="ps-3 py-3">
                                            <div class="d-flex align-items-center">
                                                <img src="<?= BASE_URL ?>assets/uploads/<?= $item['tour']->image_url ?>" width="80" height="60" style="object-fit:cover" class="rounded shadow-sm me-3" onerror="this.src='https://via.placeholder.com/80x60'">
                                                <div>
                                                    <h6 class="mb-1 fw-bold text-dark" style="max-width: 250px; text-wrap: wrap;"><?= htmlspecialchars($item['tour']->title) ?></h6>
                                                    <span class="text-danger fw-bold small"><?= number_format($item['tour']->price, 0, ',', '.') ?>đ / 1 người</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-muted small mb-1"><i class="bi bi-calendar-check text-primary"></i> Đi: <span class="fw-bold text-dark"><?= date('d/m/Y', strtotime($item['booking_date'])) ?></span></div>
                                            <div class="text-muted small"><i class="bi bi-people text-primary"></i> Số lượng: <span class="fw-bold text-dark"><?= $item['num_people'] ?> khách</span></div>
                                        </td>
                                        <td class="fw-bold text-danger fs-5">
                                            <?= number_format($item['item_total'], 0, ',', '.') ?>đ
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= BASE_URL ?>cart/remove/<?= $item['tour']->id ?>" class="btn btn-sm btn-outline-danger" title="Xóa khỏi giỏ">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="<?= BASE_URL ?>" class="btn btn-outline-primary fw-bold"><i class="bi bi-arrow-left"></i> Tiếp tục chọn tour</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-primary border-opacity-25 bg-light sticky-top" style="top: 20px;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold border-bottom border-secondary border-opacity-25 pb-3 mb-4">Tóm tắt đơn hàng</h5>
                        
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Tổng số tour:</span>
                            <span class="fw-bold text-dark"><?= count($cartItems) ?> tour</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-4 mt-2 pt-3 border-top border-secondary border-opacity-25">
                            <span class="fs-5 fw-bold text-dark">TỔNG CỘNG:</span>
                            <span class="fs-4 fw-bold text-danger"><?= number_format($totalCartPrice, 0, ',', '.') ?>đ</span>
                        </div>
                        
                        <form action="<?= BASE_URL ?>cart/checkout" method="POST">
                            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow" onclick="return confirm('Xác nhận đặt toàn bộ tour trong giỏ hàng?')">
                                <i class="bi bi-credit-card"></i> XÁC NHẬN ĐẶT TOUR
                            </button>
                        </form>
                        <p class="text-muted small text-center mt-3 mb-0"><i class="bi bi-shield-check text-success"></i> Đặt an toàn. Thanh toán sau khi được xác nhận.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded shadow-sm border mt-3">
            <i class="bi bi-cart-x text-muted opacity-50" style="font-size: 5rem;"></i>
            <h4 class="mt-3 text-muted fw-bold">Giỏ hàng trống</h4>
            <p class="text-muted">Bạn chưa chọn tour du lịch nào.</p>
            <a href="<?= BASE_URL ?>" class="btn btn-primary mt-2 px-5 fw-bold">Khám Phá Tour Ngay</a>
        </div>
    <?php endif; ?>
</div>

<?php include '../app/views/layouts/footer.php'; ?>