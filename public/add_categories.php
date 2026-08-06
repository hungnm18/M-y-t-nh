<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Đổi sang tiếng Việt cho các danh mục cũ
    $pdo->exec("UPDATE categories SET name = 'Chạy bộ' WHERE name = 'Running'");
    
    // Thêm 3-4 loại giày mới (Tiếng Việt)
    $categories = [
        ['Bóng rổ', 'Giày chơi bóng rổ'],
        ['Đá bóng', 'Giày đá bóng sân cỏ'],
        ['Tennis', 'Giày chơi quần vợt'],
        ['Tập Gym', 'Giày tập thể hình']
    ];
    
    foreach ($categories as $cat) {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE name = ?");
        $stmt->execute([$cat[0]]);
        if ($stmt->fetchColumn() == 0) {
            $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            $stmt->execute($cat);
        }
    }
    echo "Cập nhật thành công!\n";
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
}
