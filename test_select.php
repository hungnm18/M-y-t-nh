<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8", "root", "");
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Count: " . count($products) . "\n";
    print_r($products);
} catch (PDOException $e) {
    echo "Lỗi: " . $e->getMessage();
}
