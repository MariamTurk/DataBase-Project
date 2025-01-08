<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = isset($_POST['column']) ? $_POST['column'] : null;
    $order = isset($_POST['order']) ? $_POST['order'] : null;

    // Validate column and order
    $allowedColumns = ['sale_id', 'car_id', 'customer_id', 'sale_date', 'sale_price', 'payment_status'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($column, $allowedColumns) || !in_array($order, $allowedOrder)) {
        echo json_encode(["success" => false, "message" => "Invalid column or sort order."]);
        exit();
    }

    // Prepare the query for sorting
    $query = "SELECT sale_id, car_id, customer_id, sale_date, sale_price, payment_status 
              FROM sales 
              ORDER BY $column $order";

    $result = $conn->query($query);

    if ($result) {
        $sales = [];
        while ($row = $result->fetch_assoc()) {
            $sales[] = $row;
        }
        echo json_encode(["success" => true, "data" => $sales]);
    } else {
        echo json_encode(["success" => false, "message" => "Error executing query: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
