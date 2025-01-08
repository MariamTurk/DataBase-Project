<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all transactions from the database
$query = "SELECT transaction_id, sale_id, payment_method, transaction_date, amount, transaction_status, payment_type FROM Transactions";
$result = $conn->query($query);

if ($result) {
    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = $row; // Add each transaction to the array
    }
    echo json_encode(["success" => true, "data" => $transactions]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch transactions."]);
}

$conn->close();
?>
