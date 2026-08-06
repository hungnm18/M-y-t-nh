<?php
require __DIR__ . '/layouts/header.php';
?>

<!-- Breadcrumb -->
<div class="bg-light py-3 border-bottom mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= ($_ENV['APP_URL'] ?? '') ?>/" class="text-decoration-none text-dark">Trang chủ</a></li>
                <li class="breadcrumb-item active text-red fw-semibold" aria-current="page">Danh sách sản phẩm</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        
        <!-- SIDEBAR BỘ LỌC -->
        <div class="col-lg-3">
            <div class="filter-sidebar">
                <form action="<?= ($_ENV['APP_URL'] ?? '') ?>/products" method="GET" id="filterForm">
                    
                    <!-- Lọc Danh mục -->
                    <div class="filter-group">
                        <h6 class="filter-title"><i class="fa-solid fa-list me-2 text-red"></i> Phân loại</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="category_id" value="" id="cat_all" <?= empty($_GET['category_id']) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label" for="cat_all">Tất cả phân loại</label>
                        </div>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category_id" value="<?= $cat['category_id'] ?>" id="cat_<?= $cat['category_id'] ?>" <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['category_id']) ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <label class="form-check-label" for="cat_<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['name']) ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Lọc Thương hiệu -->
                    <div class="filter-group">
                        <h6 class="filter-title"><i class="fa-solid fa-tags me-2 text-red"></i> Thương hiệu</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="brand_id" value="" id="brand_all" <?= empty($_GET['brand_id']) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label" for="brand_all">Tất cả thương hiệu</label>
                        </div>
                        <?php if (!empty($brands)): ?>
                            <?php foreach ($brands as $b): ?>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="brand_id" value="<?= $b['brand_id'] ?>" id="brand_<?= $b['brand_id'] ?>" <?= (isset($_GET['brand_id']) && $_GET['brand_id'] == $b['brand_id']) ? 'checked' : '' ?> onchange="this.form.submit()">
                                    <label class="form-check-label" for="brand_<?= $b['brand_id'] ?>"><?= htmlspecialchars($b['name']) ?></label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Chọn Size Giày -->
                    <div class="filter-group">
                        <h6 class="filter-title"><i class="fa-solid fa-shoe-prints me-2 text-red"></i> Kích thước (Size)</h6>
                        <div class="size-btn-group">
                            <?php $sizes = [38, 39, 40, 41, 42, 43, 44]; ?>
                            <?php foreach ($sizes as $s): ?>
                                <input type="radio" class="btn-check" name="size" id="size_<?= $s ?>" value="<?= $s ?>" autocomplete="off" <?= (isset($_GET['size']) && $_GET['size'] == $s) ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="btn btn-outline-dark" for="size_<?= $s ?>"><?= $s ?></label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Lọc Giới Tính -->
                    <div class="filter-group">
                        <h6 class="filter-title"><i class="fa-solid fa-venus-mars me-2 text-red"></i> Giới tính</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="gender" value="" id="gender_all" <?= empty($_GET['gender']) ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label" for="gender_all">Tất cả giới tính</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="gender" value="nam" id="gender_nam" <?= (isset($_GET['gender']) && $_GET['gender'] == 'nam') ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label" for="gender_nam">Nam</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="gender" value="nu" id="gender_nu" <?= (isset($_GET['gender']) && $_GET['gender'] == 'nu') ? 'checked' : '' ?> onchange="this.form.submit()">
                            <label class="form-check-label" for="gender_nu">Nữ</label>
                        </div>
                    </div>

                    <!-- Lọc Màu Sắc -->
                    <div class="filter-group">
                        <h6 class="filter-title"><i class="fa-solid fa-palette me-2 text-red"></i> Màu sắc</h6>
                        <div class="d-flex align-items-center">
                            <span class="color-dot active" style="background-color: #000000;" title="Đen"></span>
                            <span class="color-dot" style="background-color: #ffffff;" title="Trắng"></span>
                            <span class="color-dot" style="background-color: #e63946;" title="Đỏ"></span>
                            <span class="color-dot" style="background-color: #0056b3;" title="Xanh Dương"></span>
                            <span class="color-dot" style="background-color: #6c757d;" title="Xám"></span>
                        </div>
                    </div>

                    <!-- Sắp xếp ẩn trong form -->
                    <?php if (!empty($_GET['sort'])): ?>
                        <input type="hidden" name="sort" value="<?= htmlspecialchars($_GET['sort']) ?>">
                    <?php endif; ?>

                    <a href="<?= ($_ENV['APP_URL'] ?? '') ?>/products" class="btn btn-outline-secondary w-100 mt-2 btn-sm">Xóa tất cả bộ lọc</a>
                </form>
            </div>
        </div>

        <!-- MAIN PRODUCT DISPLAY -->
        <div class="col-lg-9">
            
            <div id="product-grid-container">
                <?php require __DIR__ . '/partials/product_grid.php'; ?>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('filterForm');
    
    // Hàm gọi AJAX chung
    function fetchProducts(urlStr) {
        document.getElementById('product-grid-container').style.opacity = '0.5';
        
        fetch(urlStr, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            document.getElementById('product-grid-container').innerHTML = html;
            document.getElementById('product-grid-container').style.opacity = '1';
            // Đổi URL trên trình duyệt mà không tải lại trang
            window.history.pushState({}, '', urlStr);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('product-grid-container').style.opacity = '1';
        });
    }

    // Khi người dùng submit form (bấm Enter tìm kiếm, hoặc trigger từ JS)
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const searchParams = new URLSearchParams(formData);
        
        // Loại bỏ các param rỗng
        for (const [key, value] of [...searchParams.entries()]) {
            if (!value) {
                searchParams.delete(key);
            }
        }
        
        const urlStr = form.action + '?' + searchParams.toString();
        fetchProducts(urlStr);
    });

    // Khi click vào số phân trang
    document.addEventListener('click', function(e) {
        if (e.target.closest('.ajax-pagination a')) {
            e.preventDefault();
            let page = e.target.closest('a').getAttribute('data-page');
            if (!page) return;
            
            // Lấy lại các param hiện tại từ form
            const formData = new FormData(form);
            const searchParams = new URLSearchParams(formData);
            
            for (const [key, value] of [...searchParams.entries()]) {
                if (!value) searchParams.delete(key);
            }
            searchParams.set('page', page);
            
            const urlStr = form.action + '?' + searchParams.toString();
            fetchProducts(urlStr);
        }
    });

    // Lắng nghe sự thay đổi của radio/checkbox để submit form ngay
    // (Bỏ onchange="this.form.submit()" cũ khỏi html đi, xử lý bằng JS)
    const inputs = form.querySelectorAll('input[type="radio"], input[type="checkbox"]');
    inputs.forEach(input => {
        // Tắt onchange inline cũ nếu có
        input.removeAttribute('onchange'); 
        input.addEventListener('change', () => {
            form.dispatchEvent(new Event('submit'));
        });
    });
});
</script>

<?php require __DIR__ . '/layouts/footer.php'; ?>
