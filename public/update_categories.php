<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. Thêm cột giới tính vào products nếu chưa có
    try {
        $pdo->exec("ALTER TABLE products ADD COLUMN gender ENUM('nam', 'nu', 'unisex') DEFAULT 'unisex' AFTER description");
        echo "<p style='color:green;'>Đã thêm cột gender vào bảng products.</p>";
    } catch (PDOException $e) {
        // Nếu cột đã tồn tại thì bỏ qua
        if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
            echo "<p>Cột gender đã tồn tại, bỏ qua.</p>";
        } else {
            throw $e;
        }
    }

    // 2. Cập nhật các danh mục cũ thành tên Tiếng Việt mới
    $pdo->exec("UPDATE categories SET name = 'Chạy bộ' WHERE name = 'Running' OR name = 'Chạy bộ'");
    $pdo->exec("UPDATE categories SET name = 'Thời trang' WHERE name = 'Lifestyle' OR name = 'Thời trang'");

    // 3. Chèn thêm các phân loại mới
    $pdo->exec("INSERT INTO categories (name, description) SELECT * FROM (SELECT 'Bóng rổ', 'Giày bóng rổ') AS tmp WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Bóng rổ') LIMIT 1");
    $pdo->exec("INSERT INTO categories (name, description) SELECT * FROM (SELECT 'Đá bóng', 'Giày đá bóng') AS tmp WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Đá bóng') LIMIT 1");
    $pdo->exec("INSERT INTO categories (name, description) SELECT * FROM (SELECT 'Tennis', 'Giày chơi Tennis') AS tmp WHERE NOT EXISTS (SELECT name FROM categories WHERE name = 'Tennis') LIMIT 1");

    echo "<h2 style='color: green;'>HOÀN TẤT! Đã cập nhật Phân loại và Giới tính thành công.</h2>";
    echo "<a href='index.php?url=products'>Quay lại trang sản phẩm</a>";

} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Lỗi database: " . $e->getMessage() . "</h3>";
}
