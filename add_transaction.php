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
    $transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;
    $sale_id = isset($_POST['sale_id']) ? $_POST['sale_id'] : null;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
    $transaction_date = isset($_POST['transaction_date']) ? $_POST['transaction_date'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $transaction_status = isset($_POST['transaction_status']) ? $_POST['transaction_status'] : 'Successful';
    $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : 'Full Payment';

    // Validate required fields
    if (!$transaction_id || !$sale_id || !$payment_method || !$transaction_date || !$amount) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }

    // Validate transaction date format
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $transaction_date)) {
        echo json_encode(["success" => false, "message" => "Invalid date format. Use YYYY-MM-DD."]);
        exit();
    }

    // Prepare and execute SQL query
    $query = "INSERT INTO Transactions (transaction_id, sale_id, payment_method, transaction_date, amount, transaction_status, payment_type) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error preparing SQL statement: " . $conn->error]);
        exit();
    }

    $stmt->bind_param('iissdss', $transaction_id, $sale_id, $payment_method, $transaction_date, $amount, $transaction_status, $payment_type);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Transaction added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add transaction: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
