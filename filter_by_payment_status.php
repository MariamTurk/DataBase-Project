<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = isset($_POST['status']) ? $_POST['status'] : null;

    // Validate the payment status
    $allowedStatuses = ['Transaction', 'Plan'];
    if (!$status || !in_array($status, $allowedStatuses)) {
        echo json_encode(["success" => false, "message" => "Invalid or missing payment status."]);
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT sale_id, car_id, customer_id, sale_date, sale_price, payment_status 
                            FROM sales 
                            WHERE payment_status = ?");
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $sales = [];
        while ($row = $result->fetch_assoc()) {
            $sales[] = $row;
        }

        if (count($sales) > 0) {
            echo json_encode(["success" => true, "data" => $sales]);
        } else {
            echo json_encode(["success" => false, "message" => "No sales records found for the selected payment status."]);
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
