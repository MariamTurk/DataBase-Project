<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    // Validate the status input
    if (empty($status) || !in_array($status, ['Successful', 'Failed'])) {
        echo json_encode(["success" => false, "message" => "Invalid or missing transaction status."]);
        exit();
    }

    // Use a prepared statement to fetch transactions by status
    $stmt = $conn->prepare("SELECT transaction_id, sale_id, payment_method, transaction_date, amount, transaction_status, payment_type 
                            FROM Transactions 
                            WHERE transaction_status = ?");
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $transactions = [];
        while ($row = $result->fetch_assoc()) {
            $transactions[] = $row;
        }

        if (count($transactions) > 0) {
            echo json_encode(["success" => true, "data" => $transactions]);
        } else {
            echo json_encode(["success" => false, "message" => "No transactions found with the status '$status'."]);
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
