<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

// Include database connection
include 'db_connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $insurance_id = $_POST['insurance_id'];
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : null;
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $policy_details = isset($_POST['policy_details']) ? $_POST['policy_details'] : null;
    $expiry_date = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : null;

    // Validate the Insurance ID
    if (empty($insurance_id)) {
        echo json_encode(["success" => false, "message" => "Insurance ID is required for editing."]);
        exit();
    }

    // Dynamically build the SQL query based on the fields provided
    $fieldsToUpdate = [];
    $params = [];
    $paramTypes = "";

    if ($car_id) {
        $fieldsToUpdate[] = "car_id = ?";
        $params[] = (int)$car_id;
        $paramTypes .= "i";
    }
    if ($customer_id) {
        $fieldsToUpdate[] = "customer_id = ?";
        $params[] = (int)$customer_id;
        $paramTypes .= "i";
    }
    if ($policy_details) {
        $fieldsToUpdate[] = "policy_details = ?";
        $params[] = $policy_details;
        $paramTypes .= "s";
    }
    if ($expiry_date) {
        // Validate expiry date format
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $expiry_date)) {
            echo json_encode(["success" => false, "message" => "Invalid date format. Use YYYY-MM-DD."]);
            exit();
        }
        $fieldsToUpdate[] = "expiry_date = ?";
        $params[] = $expiry_date;
        $paramTypes .= "s";
    }

    // Add Insurance ID for the WHERE clause
    $params[] = (int)$insurance_id;
    $paramTypes .= "i";

    // Check if there are any fields to update
    if (empty($fieldsToUpdate)) {
        echo json_encode(["success" => false, "message" => "No fields to update."]);
        exit();
    }

    // Generate SQL query dynamically
    $sql = "UPDATE Insurance SET " . implode(", ", $fieldsToUpdate) . " WHERE insurance_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($paramTypes, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Insurance updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating insurance: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
