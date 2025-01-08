<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = isset($_POST['column']) ? $_POST['column'] : null;
    $order = isset($_POST['order']) ? $_POST['order'] : null;

    // Validate column and order
    $allowedColumns = ['insurance_id', 'car_id', 'customer_id', 'policy_details', 'expiry_date'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($column, $allowedColumns) || !in_array($order, $allowedOrder)) {
        echo json_encode(["success" => false, "message" => "Invalid column or sort order."]);
        exit();
    }

    // Prepare the query for sorting
    $query = "SELECT insurance_id, car_id, customer_id, policy_details, expiry_date 
              FROM Insurance 
              ORDER BY $column $order";

    $result = $conn->query($query);

    if ($result) {
        $insuranceRecords = [];
        while ($row = $result->fetch_assoc()) {
            $insuranceRecords[] = $row;
        }
        echo json_encode(["success" => true, "data" => $insuranceRecords]);
    } else {
        echo json_encode(["success" => false, "message" => "Error executing query: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
