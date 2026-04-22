<?php include '../app/views/layouts/header.php'; ?>

<div class="container mt-5">
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row bg-white shadow-sm p-4 rounded-4 mb-5 border">
        <div class="col-lg-7">
            <img src="<?= $tour->image_url ? BASE_URL.'assets/uploads/'.$tour->image_url : 'https://via.placeholder.com/800x500' ?>" class="img-fluid rounded-4 w-100 shadow-sm" style="height: 450px; object-fit: cover;">
        </div>
        
        <div class="col-lg-5 mt-4 mt-lg-0">
            <h1 class="text-primary fw-bold mb-3"><?= htmlspecialchars($tour->title) ?></h1>
            <h3 class="text-danger fw-bold mb-4"><?= number_format($tour->price, 0, ',', '.') ?> VNĐ <small class="text-muted fs-6 fw-normal">/ khách</small></h3>
            <p class="text-muted mb-4"><?= nl2br(htmlspecialchars($tour->description)) ?></p>
            
            <div class="card border-primary border-opacity-25 bg-light shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-cart-plus"></i> Đặt Tour Ngay</h5>
                    <form action="<?= BASE_URL ?>cart/add" method="POST" class="row g-3">
                        <input type="hidden" name="tour_id" value="<?= $tour->id ?>">
                        <div class="col-md-7">
                            <label class="form-label small fw-bold text-dark">Ngày đi</label>
                            <input type="date" name="booking_date" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small fw-bold text-dark">Số khách</label>
                            <input type="number" name="num_people" class="form-control" value="1" min="1" required>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">THÊM VÀO GIỎ HÀNG</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5 pt-4">
        <div class="col-lg-8">
            <h4 class="fw-bold mb-4 text-primary"><i class="bi bi-chat-square-quote-fill me-2"></i> Khách hàng nói gì?</h4>
            
            <div class="card border-0 shadow-sm mb-5 bg-white border-top border-primary border-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Gửi đánh giá của bạn</h5>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <form action="<?= BASE_URL ?>tour/postReview" method="POST">
                            <input type="hidden" name="tour_id" value="<?= $tour->id ?>">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-muted">Mức độ hài lòng:</label>
                                <select name="rating" class="form-select w-auto" required>
                                    <option value="5">⭐⭐⭐⭐⭐ (Rất tốt)</option>
                                    <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                                    <option value="3">⭐⭐⭐ (Bình thường)</option>
                                    <option value="2">⭐⭐ (Kém)</option>
                                    <option value="1">⭐ (Rất kém)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="3" placeholder="Chia sẻ cảm nhận về dịch vụ, khách sạn, hướng dẫn viên..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark px-5 fw-bold shadow-sm">GỬI BÌNH LUẬN</button>
                        </form>
                    <?php else: ?>
                        <div class="py-3 text-center border rounded-3 bg-light">
                            <p class="mb-2 text-muted">Bạn cần đăng nhập để thực hiện đánh giá chuyến đi.</p>
                            <a href="<?= BASE_URL ?>auth/login" class="btn btn-primary btn-sm fw-bold">ĐĂNG NHẬP NGAY</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="reviews">
                <?php if(!empty($reviews)): ?>
                    <?php foreach($reviews as $review): ?>
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($review->name) ?></h6>
                                    <span class="text-muted small"><?= date('d/m/Y', strtotime($review->created_at)) ?></span>
                                </div>
                                <div class="text-warning mb-2" style="font-size: 0.9rem;">
                                    <?php 
                                        for($i=1; $i<=5; $i++) {
                                            echo ($i <= $review->rating) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star text-muted"></i>';
                                        }
                                    ?>
                                </div>
                                <p class="text-secondary mb-0">"<?= nl2br(htmlspecialchars($review->comment)) ?>"</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="bi bi-chat-left-dots text-muted fs-1 opacity-25"></i>
                        <p class="text-muted mt-2">Chưa có đánh giá nào cho tour này.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../app/views/layouts/footer.php'; ?>