<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = isset($_POST['transaction_id']) ? $_POST['transaction_id'] : null;
    $sale_id = isset($_POST['sale_id']) ? $_POST['sale_id'] : null;
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
    $transaction_date = isset($_POST['transaction_date']) ? $_POST['transaction_date'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $transaction_status = isset($_POST['transaction_status']) ? $_POST['transaction_status'] : null;
    $payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : null;

    if (empty($transaction_id)) {
        echo json_encode(["success" => false, "message" => "Transaction ID is required for editing."]);
        exit();
    }

    // Build the SQL query dynamically based on the fields provided
    $fieldsToUpdate = [];
    $params = [];
    $paramTypes = "";

    if ($sale_id) {
        $fieldsToUpdate[] = "sale_id = ?";
        $params[] = (int)$sale_id;
        $paramTypes .= "i";
    }
    if ($payment_method) {
        $fieldsToUpdate[] = "payment_method = ?";
        $params[] = $payment_method;
        $paramTypes .= "s";
    }
    if ($transaction_date) {
        $fieldsToUpdate[] = "transaction_date = ?";
        $params[] = $transaction_date;
        $paramTypes .= "s";
    }
    if ($amount) {
        $fieldsToUpdate[] = "amount = ?";
        $params[] = (float)$amount;
        $paramTypes .= "d";
    }
    if ($transaction_status) {
        $fieldsToUpdate[] = "transaction_status = ?";
        $params[] = $transaction_status;
        $paramTypes .= "s";
    }
    if ($payment_type) {
        $fieldsToUpdate[] = "payment_type = ?";
        $params[] = $payment_type;
        $paramTypes .= "s";
    }

    // Add Transaction ID for the WHERE clause
    $params[] = (int)$transaction_id;
    $paramTypes .= "i";

    if (empty($fieldsToUpdate)) {
        echo json_encode(["success" => false, "message" => "No fields to update."]);
        exit();
    }

    // Generate SQL dynamically
    $sql = "UPDATE Transactions SET " . implode(", ", $fieldsToUpdate) . " WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($paramTypes, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Transaction updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating transaction: " . $stmt->error]);
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
