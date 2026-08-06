<?php
require __DIR__ . '/layouts/header.php';
?>

<!-- Breadcrumb -->
<div class="bg-light py-3 border-bottom mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= ($_ENV['APP_URL'] ?? '') ?>/" class="text-decoration-none text-dark">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= ($_ENV['APP_URL'] ?? '') ?>/cart" class="text-decoration-none text-dark">Giỏ hàng</a></li>
                <li class="breadcrumb-item active text-red fw-semibold" aria-current="page">Thanh toán đơn hàng</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container pb-5">
    <h2 class="section-title mb-4">Thanh toán & Đặt hàng</h2>

    <form action="<?= ($_ENV['APP_URL'] ?? '') ?>/checkout/process" method="POST">
        <div class="row g-5">
            
            <!-- CỘT TRÁI: THÔNG TIN GIAO HÀNG & THANH TOÁN -->
            <div class="col-lg-7">
                
                <!-- Section 1: Thông tin người nhận -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-user-pen me-2 text-red"></i> THÔNG TIN KHÁCH HÀNG & GIAO HÀNG</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Họ và tên <span class="text-red">*</span></label>
                            <input type="text" name="recipient_name" class="form-control" placeholder="Nguyễn Văn A" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Số điện thoại <span class="text-red">*</span></label>
                            <input type="tel" name="recipient_phone" class="form-control" placeholder="0987654321" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Địa chỉ Email <span class="text-red">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="nguyenvana@example.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Địa chỉ nhận hàng chi tiết <span class="text-red">*</span></label>
                            <textarea name="shipping_address" class="form-control" rows="3" placeholder="Số nhà, Tên đường, Phường/Xã, Quận/Huyện, Tỉnh/Thành phố" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Ghi chú đơn hàng (Tùy chọn)</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Ghi chú về thời gian giao hàng hoặc địa điểm cụ thể..."></textarea>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Phương thức thanh toán -->
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3"><i class="fa-solid fa-credit-card me-2 text-red"></i> PHƯƠNG THỨC THANH TOÁN</h5>
                    
                    <div class="d-flex flex-column gap-3">
                        <!-- Option 1: COD -->
                        <label class="payment-method-card active d-flex align-items-center">
                            <input type="radio" name="payment_method" value="COD" class="form-check-input me-3" checked>
                            <div>
                                <h6 class="fw-bold mb-1"><i class="fa-solid fa-hand-holding-dollar text-success me-2"></i> Thanh toán khi nhận hàng (COD)</h6>
                                <small class="text-muted">Thanh toán bằng tiền mặt trực tiếp cho shipper khi nhận được hàng.</small>
                            </div>
                        </label>

                        <!-- Option 2: Banking -->
                        <label class="payment-method-card d-flex align-items-center">
                            <input type="radio" name="payment_method" value="BANK" class="form-check-input me-3">
                            <div>
                                <h6 class="fw-bold mb-1"><i class="fa-solid fa-building-columns text-primary me-2"></i> Chuyển khoản ngân hàng (QR Code)</h6>
                                <small class="text-muted">Quét mã VietQR chuyển khoản nhanh 24/7 không tính phí.</small>
                            </div>
                        </label>

                        <!-- Option 3: E-Wallet -->
                        <label class="payment-method-card d-flex align-items-center">
                            <input type="radio" name="payment_method" value="MOMO" class="form-check-input me-3">
                            <div>
                                <h6 class="fw-bold mb-1"><i class="fa-solid fa-wallet text-danger me-2"></i> Ví điện tử Momo / VNPay</h6>
                                <small class="text-muted">Thanh toán an toàn bảo mật qua cổng ví điện tử.</small>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

            <!-- CỘT PHẢI: TÓM TẮT ĐƠN HÀNG -->
            <div class="col-lg-5">
                <div class="summary-card shadow-sm sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">ĐƠN HÀNG CỦA BẠN</h5>

                    <!-- Danh sách sản phẩm -->
                    <div class="checkout-items-list mb-4" style="max-height: 300px; overflow-y: auto;">
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <div class="d-flex align-items-center mb-3 pb-2 border-bottom">
                                    <img src="<?= !empty($item['image_url']) ? htmlspecialchars($item['image_url']) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=80' ?>" width="55" height="55" class="rounded me-3 object-fit-cover border" alt="<?= htmlspecialchars($item['name']) ?>">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0 fs-7 fw-bold"><?= htmlspecialchars($item['name']) ?></h6>
                                        <small class="text-muted">Size: <?= $item['size'] ?? '41' ?> | SL: <?= $item['quantity'] ?></small>
                                    </div>
                                    <span class="fw-bold fs-7"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Không có sản phẩm nào trong giỏ hàng.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Tóm tắt số tiền -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Tạm tính:</span>
                        <span class="fw-bold"><?= number_format($totalAmount ?? 0, 0, ',', '.') ?>đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Phí vận chuyển:</span>
                        <span class="text-success fw-bold">MIỄN PHÍ</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5">TỔNG CỘNG:</span>
                        <span class="fw-extrabold fs-3 text-red"><?= number_format($totalAmount ?? 0, 0, ',', '.') ?>đ</span>
                    </div>

                    <button type="submit" class="btn btn-red w-100 py-3 fw-bold fs-6 shadow">
                        <i class="fa-solid fa-check-circle me-2"></i> ĐẶT HÀNG NGAY
                    </button>
                    <p class="text-muted text-center fs-7 mt-3 mb-0">
                        <i class="fa-solid fa-lock me-1"></i> Thông tin được mã hóa bảo mật 256-bit SSL.
                    </p>
                </div>
            </div>

        </div>
    </form>
</div>

<?php
require __DIR__ . '/layouts/footer.php';
?>
