<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST values
    $column = isset($_POST['column']) ? $_POST['column'] : null;
    $value = isset($_POST['value']) ? $_POST['value'] : null;

    // Validate input
    if (!$column || !$value) {
        echo json_encode(["success" => false, "message" => "Both column and value are required."]);
        exit();
    }

    // Allowed columns for security
    $allowedColumns = ['plan_id', 'sale_id', 'installment_number', 'installment_amount', 'due_date', 'status'];
    if (!in_array($column, $allowedColumns)) {
        echo json_encode(["success" => false, "message" => "Invalid column name."]);
        exit();
    }

    // Prepare and execute the query for an exact match
    $stmt = $conn->prepare("SELECT plan_id, sale_id, installment_number, installment_amount, due_date, status 
                            FROM PaymentPlan 
                            WHERE $column = ?");
    $stmt->bind_param("s", $value); // Bind the exact value

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $paymentPlans = [];
        while ($row = $result->fetch_assoc()) {
            $paymentPlans[] = $row; // Collect the payment plans
        }

        if (count($paymentPlans) > 0) {
            echo json_encode(["success" => true, "data" => $paymentPlans]);
        } else {
            echo json_encode(["success" => false, "message" => "No payment plans found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error executing query: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
