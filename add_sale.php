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
    $sale_id = isset($_POST['sale_id']) ? $_POST['sale_id'] : null;
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : null;
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $sale_date = isset($_POST['sale_date']) ? $_POST['sale_date'] : null; // Corrected key
    $sale_price = isset($_POST['sale_price']) ? $_POST['sale_price'] : null; // Corrected key
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;

    // Validate required fields
    if (!$sale_id || !$car_id || !$customer_id || !$sale_date || !$sale_price || !$payment_status) {
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit();
    }

    // Prepare and execute SQL query
    $query = "INSERT INTO sales (sale_id, car_id, customer_id, sale_date, sale_price, payment_status) 
              VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iiisss', $sale_id, $car_id, $customer_id, $sale_date, $sale_price, $payment_status);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Sale added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to add sale: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>
