<?php
// insert_item.php - Insert new menu item into database

header('Content-Type: application/json');

// Database configuration
$host = 'localhost';
$dbname = 'foodmenu';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get POST data
    $food = $_POST['food'] ?? '';
    $price = $_POST['price'] ?? '';
    $image_path = $_POST['image_path'] ?? '';
    
    // Validate input
    if (empty($food) || empty($price)) {
        echo json_encode([
            'success' => false,
            'error' => 'Food name and price are required'
        ]);
        exit;
    }
    
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO `food/price` (food, price, image_path) VALUES (?, ?, ?)");
    $stmt->execute([$food, $price, $image_path]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Menu item added successfully!',
        'id' => $pdo->lastInsertId()
    ]);
    
} catch(PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>