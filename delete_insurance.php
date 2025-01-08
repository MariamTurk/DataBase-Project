<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $insurance_id = $_POST['insurance_id'];

    if (empty($insurance_id)) {
        echo json_encode(["success" => false, "message" => "Insurance ID is required for deletion."]);
        exit();
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM Insurance WHERE insurance_id = ?");
    $stmt->bind_param("i", $insurance_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Insurance record deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Insurance record not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting insurance record: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
