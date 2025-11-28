<?php
// Database configuration
$host = 'localhost';
$dbname = 'foodmenu';
$username = 'root';  // Default XAMPP username
$password = '';      // Default XAMPP password is empty

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    echo "Connected successfully!<br><br>";
    
    // Example: Fetch all records from food/price table
    $stmt = $pdo->query("SELECT * FROM `food/price`");
    $results = $stmt->fetchAll();
    
    // Display results in HTML table
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>ID</th>
            <th>Food</th>
            <th>Price</th>
            <th>Image Path</th>
          </tr>";
    
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['food']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price']) . "</td>";
        echo "<td>" . htmlspecialchars($row['image_path']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close connection (optional - PHP does this automatically)
$pdo = null;
?>