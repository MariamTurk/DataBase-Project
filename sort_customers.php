<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = $_POST['column'] ?? '';
    $order = $_POST['order'] ?? '';

    // Validate the column and order
    $allowedColumns = ['user_id', 'name', 'email', 'phone'];
    $allowedOrder = ['ASC', 'DESC'];

    if (!in_array($column, $allowedColumns) || !in_array($order, $allowedOrder)) {
        echo json_encode(["success" => false, "message" => "Invalid column or sort order."]);
        exit();
    }

    // Prepare the query
    $query = "SELECT user_id, name, email, phone, address FROM Customers ORDER BY $column $order";
    $result = $conn->query($query);

    if ($result) {
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
        echo json_encode(["success" => true, "data" => $customers]);
    } else {
        echo json_encode(["success" => false, "message" => "Error executing query: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
