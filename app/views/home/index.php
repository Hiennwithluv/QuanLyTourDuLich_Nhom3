<?php include '../app/views/layouts/header.php'; ?>

<div class="position-relative bg-primary text-white py-5" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); margin-bottom: 100px;">
    <div class="container py-5 text-center">
        <h1 class="display-4 fw-bold mb-3">KHÁM PHÁ HÀNH TRÌNH MƠ ƯỚC</h1>
        <p class="lead opacity-75 mb-5">Trải nghiệm những tour du lịch đẳng cấp với giá cực ưu đãi</p>
    </div>

    <div class="container">
        <div class="card border-0 shadow-lg rounded-4 p-4 position-absolute start-50 translate-middle-x w-100" style="bottom: -70px; max-width: 950px; z-index: 10;">
            <form action="<?= BASE_URL ?>" method="GET" class="row g-3 align-items-end">
                <div class="col-lg-5">
                    <label class="form-label fw-bold text-dark small"><i class="bi bi-search me-1 text-primary"></i> Bạn muốn đi đâu?</label>
                    <input type="text" name="keyword" class="form-control form-control-lg bg-light border-0 fs-6" 
                           placeholder="Nhập tên tour, thành phố, địa danh..." value="<?= htmlspecialchars($keyword) ?>">
                </div>
                <div class="col-lg-4">
                    <label class="form-label fw-bold text-dark small"><i class="bi bi-wallet2 me-1 text-primary"></i> Ngân sách tối đa</label>
                    <select name="max_price" class="form-select form-control-lg bg-light border-0 fs-6">
                        <option value="">-- Mọi mức giá --</option>
                        <option value="2000000" <?= $max_price == '2000000' ? 'selected' : '' ?>>Dưới 2.000.000đ</option>
                        <option value="5000000" <?= $max_price == '5000000' ? 'selected' : '' ?>>Dưới 5.000.000đ</option>
                        <option value="10000000" <?= $max_price == '10000000' ? 'selected' : '' ?>>Dưới 10.000.000đ</option>
                        <option value="20000000" <?= $max_price == '20000000' ? 'selected' : '' ?>>Dưới 20.000.000đ</option>
                    </select>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm py-2">
                        TÌM TOUR NGAY
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 pt-4">
        <h3 class="fw-bold mb-0">
            <?php if(!empty($keyword) || !empty($max_price)): ?>
                <span class="text-muted fs-5 fw-normal">Tìm thấy <?= count($tours) ?> kết quả phù hợp</span>
            <?php else: ?>
                <i class="bi bi-stars text-warning"></i> Tour Nổi Bật Gợi Ý
            <?php endif; ?>
        </h3>
        <?php if(!empty($keyword) || !empty($max_price)): ?>
            <a href="<?= BASE_URL ?>" class="btn btn-sm btn-outline-danger rounded-pill">Xóa tất cả bộ lọc</a>
        <?php endif; ?>
    </div>

    <div class="row g-4 mb-5">
        <?php if(!empty($tours)): ?>
            <?php foreach($tours as $t): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card translate-up">
                        <div class="position-relative">
                            <img src="<?= $t->image_url ? BASE_URL.'assets/uploads/'.$t->image_url : 'https://via.placeholder.com/400x250' ?>" 
                                 class="card-img-top" style="height: 230px; object-fit: cover;" alt="<?= $t->title ?>">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-dark bg-opacity-75 rounded-pill px-3 py-2"><i class="bi bi-clock me-1 text-warning"></i> <?= $t->duration ?> ngày</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="text-primary small fw-bold mb-2 text-uppercase"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($t->location) ?></div>
                            <h5 class="card-title fw-bold mb-3 text-dark"><?= htmlspecialchars($t->title) ?></h5>
                            <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                                <div class="text-danger fw-bold fs-5">
                                    <?= number_format($t->price, 0, ',', '.') ?> <small class="text-muted fw-normal" style="font-size: 0.7em;">/khách</small>
                                </div>
                                <a href="<?= BASE_URL ?>tour/detail/<?= $t->id ?>" class="btn btn-primary fw-bold px-3 rounded-3">Chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="bi bi-emoji-frown text-muted display-1 opacity-25"></i>
                <h4 class="text-muted mt-3 fw-bold">Rất tiếc, không tìm thấy tour nào phù hợp!</h4>
                <p class="text-muted">Bạn hãy thử thay đổi từ khóa hoặc mức giá khác nhé.</p>
                <a href="<?= BASE_URL ?>" class="btn btn-primary mt-2 px-4 shadow-sm">Xem tất cả tour hiện có</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .tour-card { transition: all 0.3s ease; }
    .tour-card:hover { transform: translateY(-10px); box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important; }
    .btn-primary { background-color: #0d6efd; border: none; }
    .btn-primary:hover { background-color: #0b5ed7; }
</style>

<?php include '../app/views/layouts/footer.php'; ?>