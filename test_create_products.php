<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "
    CREATE TABLE IF NOT EXISTS products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        sku VARCHAR(100) UNIQUE,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(12,2) NOT NULL CHECK (price > 0),
        sale_price DECIMAL(12,2),
        quantity INT DEFAULT 0 CHECK (quantity >= 0),
        image_url VARCHAR(255),
        category_id INT,
        brand_id INT,
        status ENUM('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE RESTRICT,
        FOREIGN KEY (brand_id) REFERENCES brands(brand_id) ON DELETE RESTRICT,
        FULLTEXT INDEX idx_product_name (name),
        CONSTRAINT chk_sale_price CHECK (sale_price <= price)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
    ";
    $pdo->exec($sql);
    echo "Thành công!";
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
