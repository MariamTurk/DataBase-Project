<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all customers from the database
$query = "SELECT user_id, name, email, phone, address FROM Customers";
$result = $conn->query($query);

if ($result) {
    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    echo json_encode(["success" => true, "data" => $customers]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch customers."]);
}

$conn->close();
?>
