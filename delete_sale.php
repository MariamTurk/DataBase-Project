<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_id = $_POST['sale_id'];

    if (empty($sale_id)) {
        echo json_encode(["success" => false, "message" => "Sale ID is required for deletion."]);
        exit();
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM Sales WHERE sale_id = ?");
    $stmt->bind_param("i", $sale_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Sale deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Sale not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting sale: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
