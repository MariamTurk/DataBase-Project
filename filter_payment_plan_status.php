<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];

    // Validate the status input
    if (empty($status)) {
        echo json_encode(["success" => false, "message" => "Status is required to filter payment plans."]);
        exit();
    }

    // Use a prepared statement to fetch payment plans by status
    $stmt = $conn->prepare("SELECT plan_id, sale_id, installment_number, installment_amount, due_date, status 
                            FROM PaymentPlan 
                            WHERE status = ?");
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $paymentPlans = [];
        while ($row = $result->fetch_assoc()) {
            $paymentPlans[] = $row;
        }

        if (count($paymentPlans) > 0) {
            echo json_encode(["success" => true, "data" => $paymentPlans]);
        } else {
            echo json_encode(["success" => false, "message" => "No payment plans found with the status '$status'."]);
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
