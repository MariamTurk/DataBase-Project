<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all cars from the database
$query = "SELECT car_id, model, year, mileage, color, transmission, price, status FROM Cars";
$result = $conn->query($query);

if ($result) {
    $cars = [];
    while ($row = $result->fetch_assoc()) {
        $cars[] = $row; // Add each car to the array
    }
    echo json_encode(["success" => true, "data" => $cars]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch cars."]);
}

$conn->close();
?>
