<?php include '../app/views/layouts/header.php'; ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-primary fw-bold text-center">Xác nhận Đặt Tour</h2>
            <div class="card shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                        <img src="<?= BASE_URL ?>assets/uploads/<?= $tour->image_url ?>" class="rounded me-4" style="width: 120px; height: 80px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/120x80'">
                        <div>
                            <h4 class="mb-1 text-dark fw-bold"><?= htmlspecialchars($tour->title) ?></h4>
                            <div class="text-muted mb-2"><i class="bi bi-clock"></i> Thời gian: <?= $tour->duration ?> ngày</div>
                            <h5 class="text-danger fw-bold mb-0" id="unitPrice" data-price="<?= $tour->price ?>"><?= number_format($tour->price, 0, ',', '.') ?> VNĐ / 1 người</h5>
                        </div>
                    </div>

                    <form action="<?= BASE_URL ?>booking/process" method="POST">
                        <input type="hidden" name="tour_id" value="<?= $tour->id ?>">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Ngày khởi hành (Dự kiến)</label>
                                <input type="date" name="booking_date" class="form-control form-control-lg" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Số lượng người</label>
                                <input type="number" name="num_people" id="numPeople" class="form-control form-control-lg" value="1" min="1" max="50" required>
                            </div>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div>
                                <span class="text-muted fs-5">Tổng thanh toán:</span><br>
                                <h2 class="text-danger fw-bold mb-0" id="totalPriceDisplay"><?= number_format($tour->price, 0, ',', '.') ?> VNĐ</h2>
                            </div>
                            <button type="submit" class="btn btn-success btn-lg px-5 fw-bold">XÁC NHẬN ĐẶT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JS tính tổng tiền realtime
    const numInput = document.getElementById('numPeople');
    const priceDisplay = document.getElementById('totalPriceDisplay');
    const unitPrice = parseFloat(document.getElementById('unitPrice').getAttribute('data-price'));

    numInput.addEventListener('input', function() {
        let count = parseInt(this.value) || 0;
        if(count < 1) count = 1;
        let total = unitPrice * count;
        priceDisplay.innerText = new Intl.NumberFormat('vi-VN').format(total) + ' VNĐ';
    });
</script>
<?php include '../app/views/layouts/footer.php'; ?>