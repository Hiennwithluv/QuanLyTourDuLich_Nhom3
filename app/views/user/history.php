<?php include '../app/views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Lịch sử đặt Tour của bạn</h2>
        <span class="badge bg-primary fs-6">Khách hàng: <?= $_SESSION['name'] ?></span>
    </div>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mã Đơn</th>
                            <th>Tour đã đặt</th>
                            <th>Ngày đi</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($bookings)): foreach($bookings as $b): ?>
                        <tr>
                            <td class="fw-bold">#<?= $b->id ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= BASE_URL ?>assets/uploads/<?= $b->image_url ?>" width="50" height="50" style="object-fit:cover" class="rounded-circle me-3" onerror="this.src='https://via.placeholder.com/50'">
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($b->tour_title) ?></span>
                                </div>
                            </td>
                            <td><?= date('d/m/Y', strtotime($b->booking_date)) ?></td>
                            <td><?= $b->num_people ?> người</td>
                            <td class="fw-bold text-danger"><?= number_format($b->total_price, 0, ',', '.') ?>đ</td>
                            <td>
                                <?php 
                                    $bg = 'warning'; $text = 'Chờ duyệt';
                                    if($b->status == 'confirmed') { $bg = 'success'; $text = 'Đã chốt'; }
                                    if($b->status == 'completed') { $bg = 'primary'; $text = 'Hoàn thành'; }
                                    if($b->status == 'cancelled') { $bg = 'danger'; $text = 'Đã hủy'; }
                                ?>
                                <span class="badge bg-<?= $bg ?>"><?= $text ?></span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <h5 class="text-muted mb-3">Bạn chưa đặt chuyến đi nào.</h5>
                                <a href="<?= BASE_URL ?>" class="btn btn-primary">Xem tour ngay</a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include '../app/views/layouts/footer.php'; ?>