<?php
require __DIR__ . '/layouts/header.php';
?>

<!-- Breadcrumb -->
<div class="bg-light py-3 border-bottom mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= ($_ENV['APP_URL'] ?? '') ?>/" class="text-decoration-none text-dark">Trang chủ</a></li>
                <li class="breadcrumb-item active text-red fw-semibold" aria-current="page">Giỏ hàng của bạn</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container pb-5">
    <h2 class="section-title mb-4">Giỏ hàng (<span class="text-red"><?= count($cartItems ?? []) ?></span> sản phẩm)</h2>

    <?php if (!empty($cartItems)): ?>
        <div class="row g-4">
            <!-- CỘT TRÁI: BẢNG SẢN PHẨM IN CART -->
            <div class="col-lg-8">
                <div class="table-responsive border rounded-3 shadow-sm">
                    <table class="table cart-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Size</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalAmount = 0; ?>
                            <?php foreach ($cartItems as $item): ?>
                                <?php 
                                    $itemSubtotal = $item['price'] * $item['quantity'];
                                    $totalAmount += $itemSubtotal;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= !empty($item['image_url']) ? htmlspecialchars($item['image_url']) : 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=80' ?>" width="70" height="70" class="rounded me-3 object-fit-cover border" alt="<?= htmlspecialchars($item['name']) ?>">
                                            <div>
                                                <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/product/<?= $item['product_id'] ?>" class="fw-bold text-dark text-decoration-none d-block mb-1"><?= htmlspecialchars($item['name']) ?></a>
                                                <span class="badge bg-light text-dark border">Chính Hãng</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-secondary fs-7"><?= htmlspecialchars($item['size'] ?? '41') ?></span></td>
                                    <td class="fw-bold"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                    <td>
                                        <div class="quantity-selector input-group input-group-sm" style="max-width: 100px;">
                                            <input type="number" class="form-control text-center" value="<?= $item['quantity'] ?>" min="1">
                                        </div>
                                    </td>
                                    <td class="fw-bold text-red"><?= number_format($itemSubtotal, 0, ',', '.') ?>đ</td>
                                    <td>
                                        <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/cart/remove/<?= $item['product_id'] ?>" class="btn btn-sm btn-outline-danger" title="Xóa"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/products" class="btn btn-outline-dark-custom btn-sm"><i class="fa-solid fa-arrow-left me-1"></i> Tiếp tục mua hàng</a>
                    <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/cart/clear" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-broom me-1"></i> Xóa tất cả</a>
                </div>
            </div>

            <!-- CỘT PHẢI: TỔNG TIỀN & MÃ GIẢM GIÁ -->
            <div class="col-lg-4">
                <div class="summary-card">
                    <h5 class="fw-bold mb-3 border-bottom pb-2">TỔNG ĐƠN HÀNG</h5>
                    
                    <!-- Mã giảm giá -->
                    <div class="mb-4">
                        <label class="form-label fs-7 fw-bold">MÃ GIẢM GIÁ / VOUCHER</label>
                        <div class="input-group">
                            <input type="text" class="form-control text-uppercase" placeholder="Nhập mã ưu đãi...">
                            <button class="btn btn-dark" type="button">Áp dụng</button>
                        </div>
                    </div>

                    <!-- Tóm tắt chi phí -->
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Tạm tính:</span>
                        <span class="fw-bold"><?= number_format($totalAmount, 0, ',', '.') ?>đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Giảm giá:</span>
                        <span class="text-success fw-bold">-0đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-secondary">Phí vận chuyển:</span>
                        <span class="text-success fw-semibold">MIỄN PHÍ</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold fs-5">TỔNG TIỀN:</span>
                        <span class="fw-extrabold fs-4 text-red"><?= number_format($totalAmount, 0, ',', '.') ?>đ</span>
                    </div>

                    <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/checkout" class="btn btn-red w-100 py-3 fw-bold fs-6">
                        PROCEED TO CHECKOUT <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- GIỎ HÀNG TRỐNG -->
        <div class="text-center py-5">
            <i class="fa-solid fa-cart-arrow-down fs-1 text-muted mb-3" style="font-size: 4rem !important;"></i>
            <h3 class="fw-bold mt-2">Giỏ hàng của bạn đang trống!</h3>
            <p class="text-secondary">Hãy chọn sản phẩm ưng ý và thêm vào giỏ hàng ngay nhé.</p>
            <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/products" class="btn btn-red btn-lg px-4 py-2 mt-2"><i class="fa-solid fa-bag-shopping me-2"></i> KHÁM PHÁ SẢN PHẨM</a>
        </div>
    <?php endif; ?>
</div>

<?php
require __DIR__ . '/layouts/footer.php';
?>
