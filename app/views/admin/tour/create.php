<?php include '../app/views/layouts/admin_layout.php'; ?>

<div class="mb-4">
    <a href="<?= BASE_URL ?>admin/tour" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left"></i> Quay lại danh sách
    </a>
    <h2 class="fw-bold text-primary mt-2">Thêm Tour Du Lịch Mới</h2>
</div>

<div class="card shadow-sm border-0 rounded-4 p-2">
    <div class="card-body">
        <form action="<?= BASE_URL ?>admin/tour/store" method="POST" enctype="multipart/form-data">
            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label fw-bold">Tên Tour</label>
                    <input type="text" name="title" class="form-control" placeholder="Ví dụ: Tour Hạ Long 2 ngày 1 đêm" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Giá tour (VNĐ)</label>
                    <input type="number" name="price" class="form-control" required min="0" max="999999999" placeholder="Nhập số tiền">
                </div>
                
                <div class="col-md-4">
                    <label class="form-label fw-bold">Địa điểm</label>
                    <input type="text" name="location" class="form-control" placeholder="Hà Nội, Sapa..." required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Thời gian (Ngày)</label>
                    <input type="number" name="duration" class="form-control" value="1" min="1" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="active">Hoạt động (Active)</option>
                        <option value="inactive">Tạm ẩn (Inactive)</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Hình ảnh đại diện</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-bold">Mô tả chuyến đi</label>
                    <textarea name="description" class="form-control" rows="6" placeholder="Lịch trình chi tiết, dịch vụ bao gồm..."></textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch p-lg-2 bg-light rounded border px-5">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="flexSwitchCheckDefault">
                        <label class="form-check-label fw-bold text-danger" for="flexSwitchCheckDefault">Đánh dấu là Tour Nổi Bật (Hiện lên Trang Chủ)</label>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary btn-lg px-5 fw-bold shadow-sm">LƯU TOUR</button>
            </div>
        </form>
    </div>
</div>

        </div> 
    </div> 
</body>
</html>