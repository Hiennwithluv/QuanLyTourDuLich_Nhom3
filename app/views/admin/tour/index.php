<?php include '../app/views/layouts/admin_layout.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="bi bi-map-fill text-primary"></i> Danh sách Tour</h2>
    <a href="<?= BASE_URL ?>admin/tour/create" class="btn btn-primary fw-bold shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> THÊM TOUR MỚI
    </a>
</div>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4 py-3">#ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên Tour</th>
                        <th>Giá Tour</th>
                        <th>Địa điểm</th>
                        <th>Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($tours)): foreach($tours as $t): ?>
                    <tr>
                        <td class="ps-4 fw-bold text-muted"><?= $t->id ?></td>
                        <td>
                            <img src="<?= $t->image_url ? BASE_URL.'assets/uploads/'.$t->image_url : 'https://via.placeholder.com/100x60' ?>" 
                                 class="rounded-3 shadow-sm border" width="80" height="55" style="object-fit: cover;">
                        </td>
                        <td>
                            <div class="fw-bold text-dark"><?= htmlspecialchars($t->title) ?></div>
                            <?php if($t->is_featured): ?>
                                <span class="badge bg-danger p-1 small" style="font-size: 0.6rem;">HOT</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-danger fw-bold"><?= number_format($t->price, 0, ',', '.') ?>đ</td>
                        <td><small><i class="bi bi-geo-alt me-1"></i><?= htmlspecialchars($t->location) ?></small></td>
                        <td>
                            <span class="badge py-2 px-3 rounded-pill bg-<?= $t->status == 'active' ? 'success' : 'secondary' ?> bg-opacity-10 text-<?= $t->status == 'active' ? 'success' : 'secondary' ?>">
                                <?= strtoupper($t->status) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>admin/tour/edit/<?= $t->id ?>" class="btn btn-sm btn-outline-warning border-0" title="Sửa">
                                <i class="bi bi-pencil-square fs-5"></i>
                            </a>
                            <a href="<?= BASE_URL ?>admin/tour/delete/<?= $t->id ?>" class="btn btn-sm btn-outline-danger border-0" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')" title="Xóa">
                                <i class="bi bi-trash3 fs-5"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr><td colspan="7" class="text-center py-5 text-muted">Chưa có tour nào trong hệ thống.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

            </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>