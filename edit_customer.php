<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Ensure response is in JSON format

include 'db_connect.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $field = isset($_POST['field']) ? trim($_POST['field']) : '';
    $value = isset($_POST['value']) ? trim($_POST['value']) : '';

    // Validate inputs
    if (!$user_id || empty($field) || empty($value)) {
        echo json_encode(["success" => false, "message" => "Invalid input. All fields are required."]);
        exit;
    }

    // Ensure the field is valid
    $allowed_fields = ['name', 'email', 'phone', 'address'];
    if (!in_array($field, $allowed_fields)) {
        echo json_encode(["success" => false, "message" => "Invalid field name."]);
        exit;
    }

    // Check if the customer exists
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM Customers WHERE user_id = ?");
    if (!$checkStmt) {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement for checking existence."]);
        exit;
    }

    $checkStmt->bind_param('i', $user_id);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count === 0) {
        echo json_encode(["success" => false, "message" => "Customer ID does not exist."]);
        exit;
    }

    // Prepare the SQL query for updating the record
    $stmt = $conn->prepare("UPDATE Customers SET $field = ? WHERE user_id = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Failed to prepare update statement."]);
        exit;
    }

    // Bind parameters and execute
    $stmt->bind_param('si', $value, $user_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Customer updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Error updating customer: " . $stmt->error]);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
