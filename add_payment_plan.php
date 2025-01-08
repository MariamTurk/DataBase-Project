<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Include database connection
include 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch POST data
    $plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : null;
    $sale_id = isset($_POST['sale_id']) ? $_POST['sale_id'] : null;
    $installment_number = isset($_POST['installment_number']) ? $_POST['installment_number'] : null;
    $installment_amount = isset($_POST['installment_amount']) ? $_POST['installment_amount'] : null;
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : 'Pending';

    // Validate required fields
    if (!$plan_id || !$sale_id || !$installment_number || !$installment_amount || !$due_date || !$status) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }

    // Prepare and execute SQL query
    $query = "INSERT INTO PaymentPlan (plan_id, sale_id, installment_number, installment_amount, due_date, status) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiidss', $plan_id, $sale_id, $installment_number, $installment_amount, $due_date, $status);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Payment plan added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add payment plan: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
