<?php
// Tự động setup database
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Đọc file schema
    $schema = file_get_contents(__DIR__ . '/database/schema.sql');
    if ($schema) {
        $pdo->exec($schema);
        echo "<h3>1. Tạo các bảng (schema.sql) thành công!</h3>";
    }
    
    // Đọc file seed
    $seed = file_get_contents(__DIR__ . '/database/seed.sql');
    if ($seed) {
        $pdo->exec($seed);
        echo "<h3>2. Nạp dữ liệu mẫu (seed.sql) thành công!</h3>";
    }
    
    echo "<h2 style='color: green;'>HOÀN TẤT! Bạn có thể quay lại trang web để xem sản phẩm.</h2>";
    echo "<a href='public/'>Quay lại trang chủ</a>";
    
} catch (PDOException $e) {
    echo "<h3 style='color: red;'>Lỗi database: " . $e->getMessage() . "</h3>";
} catch (Exception $e) {
    echo "<h3 style='color: red;'>Lỗi: " . $e->getMessage() . "</h3>";
}
