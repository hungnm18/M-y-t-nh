<?php
require __DIR__ . '/layouts/header.php';
?>

<div class="auth-wrapper bg-light">
    <div class="auth-card">
        <!-- Logo -->
        <div class="text-center mb-4">
            <a class="navbar-brand navbar-brand-logo fs-2 text-dark" href="<?= ($_ENV['APP_URL'] ?? '') ?>/">
                SPORT<span class="text-red">SHOES</span>
            </a>
            <h5 class="fw-bold mt-2 text-uppercase">Đăng ký tài khoản</h5>
            <p class="text-secondary fs-7">Tạo tài khoản để nhận vô vàn ưu đãi hấp dẫn!</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2 fs-7 mb-3">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Form Đăng ký -->
        <form action="<?= ($_ENV['APP_URL'] ?? '') ?>/register" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold fs-7">Họ và tên</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold fs-7">Địa chỉ Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold fs-7">Số điện thoại</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-phone"></i></span>
                    <input type="tel" name="phone" class="form-control" placeholder="0987654321">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold fs-7">Mật khẩu (Tối thiểu 6 ký tự)</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" minlength="6" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold fs-7">Xác nhận mật khẩu</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-shield"></i></span>
                    <input type="password" name="password_confirm" class="form-control" placeholder="••••••••" minlength="6" required>
                </div>
            </div>

            <button type="submit" class="btn btn-red w-100 py-2.5 fw-bold text-uppercase mb-3">ĐĂNG KÝ TÀI KHOẢN</button>

            <div class="text-center fs-7">
                <span class="text-secondary">Đã có tài khoản?</span>
                <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/login" class="text-red fw-bold text-decoration-none ms-1">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
</div>

<?php
require __DIR__ . '/layouts/footer.php';
?>
