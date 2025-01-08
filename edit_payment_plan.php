<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = isset($_POST['plan_id']) ? $_POST['plan_id'] : null;

    if (empty($plan_id)) {
        echo json_encode(["success" => false, "message" => "Plan ID is required for editing."]);
        exit();
    }

    // Collect optional fields
    $sale_id = isset($_POST['sale_id']) ? $_POST['sale_id'] : null;
    $installment_number = isset($_POST['installment_number']) ? $_POST['installment_number'] : null;
    $installment_amount = isset($_POST['installment_amount']) ? $_POST['installment_amount'] : null;
    $due_date = isset($_POST['due_date']) ? $_POST['due_date'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    // Build the SQL query dynamically
    $fieldsToUpdate = [];
    $params = [];
    $paramTypes = "";

    if ($sale_id) {
        $fieldsToUpdate[] = "sale_id = ?";
        $params[] = (int)$sale_id;
        $paramTypes .= "i";
    }
    if ($installment_number) {
        $fieldsToUpdate[] = "installment_number = ?";
        $params[] = (int)$installment_number;
        $paramTypes .= "i";
    }
    if ($installment_amount) {
        $fieldsToUpdate[] = "installment_amount = ?";
        $params[] = (float)$installment_amount;
        $paramTypes .= "d";
    }
    if ($due_date) {
        $fieldsToUpdate[] = "due_date = ?";
        $params[] = $due_date;
        $paramTypes .= "s";
    }
    if ($status) {
        $fieldsToUpdate[] = "status = ?";
        $params[] = $status;
        $paramTypes .= "s";
    }

    // Add plan_id for the WHERE clause
    $params[] = (int)$plan_id;
    $paramTypes .= "i";

    if (empty($fieldsToUpdate)) {
        echo json_encode(["success" => false, "message" => "No fields to update."]);
        exit();
    }

    $sql = "UPDATE PaymentPlan SET " . implode(", ", $fieldsToUpdate) . " WHERE plan_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($paramTypes, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Payment plan updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating payment plan: " . $stmt->error]);
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
