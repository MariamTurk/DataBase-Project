<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];

    if (empty($transaction_id)) {
        echo json_encode(["success" => false, "message" => "Transaction ID is required for deletion."]);
        exit();
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM Transactions WHERE transaction_id = ?");
    $stmt->bind_param("i", $transaction_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Transaction deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Transaction not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting transaction: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
