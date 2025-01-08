<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = $_POST['column'];
    $order = $_POST['order'];

    // Validate column and order
    $allowedColumns = ['car_id', 'model', 'year', 'mileage', 'color', 'transmission', 'price', 'status'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($column, $allowedColumns) || !in_array($order, $allowedOrder)) {
        echo json_encode(["success" => false, "message" => "Invalid column or sort order."]);
        exit();
    }

    // Prepare the query for sorting
    $query = "SELECT car_id, model, year, mileage, color, transmission, price, status 
              FROM Cars 
              ORDER BY $column $order";

    $result = $conn->query($query);

    if ($result) {
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }
        echo json_encode(["success" => true, "data" => $cars]);
    } else {
        echo json_encode(["success" => false, "message" => "Error executing query: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
