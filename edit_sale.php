<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_id = $_POST['sale_id'];
    $car_id = isset($_POST['car_id']) ? $_POST['car_id'] : null;
    $customer_id = isset($_POST['customer_id']) ? $_POST['customer_id'] : null;
    $sale_date = isset($_POST['sale_date']) ? $_POST['sale_date'] : null;
    $sale_price = isset($_POST['sale_price']) ? $_POST['sale_price'] : null;
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : null;

    if (empty($sale_id)) {
        echo json_encode(["success" => false, "message" => "Sale ID is required for editing."]);
        exit();
    }

    // Build the SQL query dynamically based on the fields provided
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
    if ($sale_date) {
        $fieldsToUpdate[] = "sale_date = ?";
        $params[] = $sale_date;
        $paramTypes .= "s";
    }
    if ($sale_price) {
        $fieldsToUpdate[] = "sale_price = ?";
        $params[] = (float)$sale_price;
        $paramTypes .= "d";
    }
    if ($payment_status) {
        $fieldsToUpdate[] = "payment_status = ?";
        $params[] = $payment_status;
        $paramTypes .= "s";
    }

    // Add Sale ID for the WHERE clause
    $params[] = (int)$sale_id;
    $paramTypes .= "i";

    if (empty($fieldsToUpdate)) {
        echo json_encode(["success" => false, "message" => "No fields to update."]);
        exit();
    }

    // Generate SQL dynamically
    $sql = "UPDATE Sales SET " . implode(", ", $fieldsToUpdate) . " WHERE sale_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($paramTypes, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Sale updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating sale: " . $stmt->error]);
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
