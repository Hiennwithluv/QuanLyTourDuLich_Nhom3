<?php include '../app/views/layouts/admin_layout.php'; ?>

<h2 class="fw-bold mb-4"><i class="bi bi-cart-check-fill text-primary"></i> Quản lý Đơn hàng</h2>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Mã Đơn</th>
                        <th>Khách hàng</th>
                        <th>Tour & Ngày đi</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $b): ?>
                    <tr>
                        <td class="ps-4 fw-bold">#<?= $b->id ?></td>
                        <td>
                            <div class="fw-bold"><?= htmlspecialchars($b->user_name) ?></div>
                            <small class="text-muted">ID khách: <?= $b->user_id ?></small>
                        </td>
                        <td>
                            <div class="text-primary fw-bold"><?= htmlspecialchars($b->tour_title) ?></div>
                            <small><i class="bi bi-calendar"></i> <?= date('d/m/Y', strtotime($b->booking_date)) ?> | <?= $b->num_people ?> khách</small>
                        </td>
                        <td class="text-danger fw-bold"><?= number_format($b->total_price) ?>đ</td>
                        <td>
                            <form action="<?= BASE_URL ?>admin/booking/updateStatus" method="POST" class="d-flex gap-1">
                                <input type="hidden" name="booking_id" value="<?= $b->id ?>">
                                <select name="status" class="form-select form-select-sm" style="width: 130px;">
                                    <option value="pending" <?= $b->status == 'pending' ? 'selected' : '' ?>>Chờ duyệt</option>
                                    <option value="confirmed" <?= $b->status == 'confirmed' ? 'selected' : '' ?>>Xác nhận</option>
                                    <option value="completed" <?= $b->status == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                    <option value="cancelled" <?= $b->status == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                </select>
                                <select name="payment_status" class="form-select form-select-sm" style="width: 130px;">
                                    <option value="unpaid" <?= $b->payment_status == 'unpaid' ? 'selected' : '' ?>>Chưa trả</option>
                                    <option value="paid" <?= $b->payment_status == 'paid' ? 'selected' : '' ?>>Đã trả</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-check-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            </div> </div> </div> </body>
</html>