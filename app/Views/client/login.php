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
            <h5 class="fw-bold mt-2 text-uppercase">Đăng nhập tài khoản</h5>
            <p class="text-secondary fs-7">Chào mừng bạn quay trở lại với Sport Shoes!</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2 fs-7 mb-3">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Form Đăng nhập -->
        <form action="<?= ($_ENV['APP_URL'] ?? '') ?>/login" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold fs-7">Địa chỉ Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label fw-semibold fs-7 mb-0">Mật khẩu</label>
                    <a href="#" class="text-red fs-7 text-decoration-none">Quên mật khẩu?</a>
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label fs-7" for="remember">Ghi nhớ đăng nhập</label>
            </div>

            <button type="submit" class="btn btn-red w-100 py-2.5 fw-bold text-uppercase mb-3">ĐĂNG NHẬP</button>

            <div class="text-center fs-7">
                <span class="text-secondary">Chưa có tài khoản?</span>
                <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/register" class="text-red fw-bold text-decoration-none ms-1">Đăng ký ngay</a>
            </div>
        </form>
    </div>
</div>

<?php
require __DIR__ . '/layouts/footer.php';
?>
