<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=shop_giay;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if Lifestyle category exists
    $stmt = $pdo->query("SELECT category_id FROM categories WHERE name = 'Lifestyle'");
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($category) {
        $categoryId = $category['category_id'];
        
        // Check if there are any products associated with this category
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM products WHERE category_id = :id");
        $stmt->execute(['id' => $categoryId]);
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            echo "Cannot delete because there are $count products associated with 'Lifestyle' category.\n";
        } else {
            $pdo->exec("DELETE FROM categories WHERE category_id = $categoryId");
            echo "Successfully deleted 'Lifestyle' category.\n";
        }
    } else {
        echo "'Lifestyle' category not found.\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
