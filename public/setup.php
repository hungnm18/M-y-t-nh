<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Đọc file schema
    $schema = file_get_contents(__DIR__ . '/../database/schema.sql');
    if ($schema) {
        $pdo->exec($schema);
    }
    
    // Nạp RIÊNG sản phẩm để tránh lỗi trùng lặp categories/users đã có sẵn
    $seedProducts = "
    INSERT IGNORE INTO products (sku, name, description, price, sale_price, quantity, category_id, brand_id, status) VALUES
    ('NK-RN-001', 'Nike Air Zoom Pegasus 39', 'Giày chạy êm ái', 3000000.00, 2500000.00, 50, 1, 1, 'active'),
    ('AD-RN-003', 'Adidas Ultraboost 22', 'Giày chạy siêu nhẹ', 3500000.00, 3200000.00, 30, 1, 2, 'active'),
    ('NK-RN-005', 'Nike React Infinity Run', 'Giày chạy chống chấn thương', 3200000.00, 2800000.00, 40, 1, 1, 'active');
    ";
    
    $pdo->exec($seedProducts);
    
    echo "<h2 style='color: green;'>HOÀN TẤT! Đã nạp thành công dữ liệu sản phẩm.</h2>";
    echo "<a href='index.php?url=products'>Quay lại trang sản phẩm</a>";
    
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Lỗi database: " . $e->getMessage() . "</h3>";
}
