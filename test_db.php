<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8", "root", "");
    $stmt = $pdo->query('SELECT * FROM categories');
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
