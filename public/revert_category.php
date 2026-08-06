<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Đổi lại thành Lifestyle
    $pdo->exec("UPDATE categories SET name = 'Lifestyle' WHERE name = 'Thời trang'");
    
    echo "<h2 style='color:green;'>Đã đổi 'Thời trang' trở lại thành 'Lifestyle' thành công!</h2>";
    echo "<a href='index.php?url=products'>Quay lại trang sản phẩm</a>";

} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
