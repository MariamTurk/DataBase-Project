<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Ensure this includes your database connection logic

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all sales records from the database
$query = "SELECT sale_id, car_id, customer_id, sale_date, sale_price, payment_status FROM sales";
$result = $conn->query($query);

if ($result) {
    $sales = [];
    while ($row = $result->fetch_assoc()) {
        $sales[] = $row; // Add each sale to the array
    }
    echo json_encode(["success" => true, "data" => $sales]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch sales records."]);
}

$conn->close();
?>
