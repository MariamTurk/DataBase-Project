<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Ensure this includes your database connection logic

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

// Fetch all payment plan records from the database
$query = "SELECT plan_id, sale_id, installment_number, installment_amount, due_date, status FROM PaymentPlan ORDER BY due_date DESC";
$result = $conn->query($query);

if ($result) {
    $paymentPlans = [];
    while ($row = $result->fetch_assoc()) {
        $paymentPlans[] = $row; // Add each payment plan to the array
    }
    echo json_encode(["success" => true, "data" => $paymentPlans]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to fetch payment plans."]);
}

$conn->close();
?>
