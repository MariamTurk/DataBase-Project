<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize input
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;

    // Validate input
    if (!$user_id) {
        echo json_encode(["success" => false, "message" => "Invalid Customer ID."]);
        exit;
    }

    // Prepare the SQL query
    $stmt = $conn->prepare("DELETE FROM Customers WHERE user_id = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement."]);
        exit;
    }

    // Bind the parameter and execute
    $stmt->bind_param('i', $user_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Customer deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "No customer found with the given ID."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting customer: " . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
