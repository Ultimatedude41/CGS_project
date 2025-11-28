<?php
// menu_data.php - Returns JSON or HTML based on request

// Database configuration
$host = 'localhost';
$dbname = 'foodmenu';
$username = 'root';
$password = '';

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Fetch all menu items
    $stmt = $pdo->query("SELECT * FROM `food/price`");
    $results = $stmt->fetchAll();
    
    // Check if JSON format is requested (for JavaScript fetch)
    if (isset($_GET['format']) && $_GET['format'] === 'json') {
        // Return JSON for JavaScript
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $results
        ]);
    } else {
        // Display as HTML table for testing
        echo "<!DOCTYPE html>";
        echo "<html><head><title>Menu Data</title></head><body>";
        echo "<h2>Connected successfully!</h2>";
        echo "<p><a href='menu.html'>View Menu Page</a> | <a href='?format=json'>View JSON</a></p>";
        
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse;'>";
        echo "<thead><tr style='background-color: #f4a460; color: white;'>
                <th>ID</th>
                <th>Food</th>
                <th>Price</th>
                <th>Image Path</th>
              </tr></thead>";
        echo "<tbody>";
        
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['food']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            echo "<td>" . htmlspecialchars($row['image_path']) . "</td>";
            echo "</tr>";
        }
        
        echo "</tbody></table>";
        echo "</body></html>";
    }
    
} catch(PDOException $e) {
    if (isset($_GET['format']) && $_GET['format'] === 'json') {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    } else {
        echo "<h2>Connection failed: " . htmlspecialchars($e->getMessage()) . "</h2>";
    }
}

$pdo = null;
?>