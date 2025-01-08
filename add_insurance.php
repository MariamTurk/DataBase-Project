<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Include database connection
include 'db_connect.php';

// Check if the database connection is successful
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit();
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $insurance_id = isset($_POST['insurance_id']) ? $_POST['insurance_id'] : null;
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : null;
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $policy_details = isset($_POST['policy_details']) ? $_POST['policy_details'] : null;
    $expiry_date = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : null;

    // Validate required fields
    if (!$insurance_id || !$car_id || !$customer_id || !$policy_details || !$expiry_date) {
        echo json_encode([
            "success" => false,
            "message" => "All fields are required."
        ]);
        exit();
    }

    // Validate expiry date format
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $expiry_date)) {
        echo json_encode([
            "success" => false,
            "message" => "Invalid date format. Use YYYY-MM-DD."
        ]);
        exit();
    }

    // Prepare and execute SQL query
    $query = "INSERT INTO Insurance (insurance_id, car_id, customer_id, policy_details, expiry_date) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "success" => false,
            "message" => "Error preparing SQL statement: " . $conn->error
        ]);
        exit();
    }

    $stmt->bind_param('iiiss', $insurance_id, $car_id, $customer_id, $policy_details, $expiry_date);

    if ($stmt->execute()) {
        echo json_encode([
            "success" => true,
            "message" => "Insurance added successfully!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to add insurance: " . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method."
    ]);
}

$conn->close();
?>
