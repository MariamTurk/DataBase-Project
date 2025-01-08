<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plan_id = $_POST['plan_id'];

    if (empty($plan_id)) {
        echo json_encode(["success" => false, "message" => "Plan ID is required for deletion."]);
        exit();
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM PaymentPlan WHERE plan_id = ?");
    $stmt->bind_param("i", $plan_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Payment plan deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Payment plan not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting payment plan: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
