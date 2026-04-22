<?php include '../app/views/layouts/admin_layout.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Cập nhật Tour</h2>
    <a href="<?= BASE_URL ?>admin/tour" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Quay lại</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= BASE_URL ?>admin/tour/update/<?= $tour->id ?>" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tên Tour</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($tour->title) ?>" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Giá (VNĐ)</label>
                    <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($tour->price) ?>" required min="0">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold">Thời gian (Ngày)</label>
                    <input type="number" name="duration" class="form-control" value="<?= htmlspecialchars($tour->duration) ?>" required min="1">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Địa điểm</label>
                    <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($tour->location) ?>" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="active" <?= $tour->status == 'active' ? 'selected' : '' ?>>Hiển thị (Active)</option>
                        <option value="inactive" <?= $tour->status == 'inactive' ? 'selected' : '' ?>>Ẩn (Inactive)</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Hình ảnh đại diện (Bỏ trống nếu không muốn đổi)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <?php if($tour->image_url): ?>
                    <div class="mt-2">
                        <img src="<?= BASE_URL ?>assets/uploads/<?= $tour->image_url ?>" width="150" class="rounded shadow-sm">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả chi tiết</label>
                <textarea name="description" class="form-control" rows="5"><?= htmlspecialchars($tour->description) ?></textarea>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" <?= $tour->is_featured ? 'checked' : '' ?>>
                <label class="form-check-label fw-bold text-danger" for="isFeatured">
                    Đánh dấu là Tour Nổi Bật (Hiển thị ra trang chủ)
                </label>
            </div>

            <button type="submit" class="btn btn-warning px-5 fw-bold"><i class="bi bi-save"></i> CẬP NHẬT</button>
        </form>
    </div>
</div>

        </div> 
    </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html