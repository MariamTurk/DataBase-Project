<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Validate the column name
    $allowedColumns = ['car_id', 'model', 'year', 'mileage', 'color', 'transmission', 'price', 'status'];
    if (!in_array($column, $allowedColumns)) {
        echo json_encode(["success" => false, "message" => "Invalid column name."]);
        exit();
    }

    // Prepare and execute the query for an exact match
    $stmt = $conn->prepare("SELECT car_id, model, year, mileage, color, transmission, price, status 
                            FROM Cars 
                            WHERE $column = ?");
    $stmt->bind_param("s", $value); // Bind the exact value

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        if (count($cars) > 0) {
            echo json_encode(["success" => true, "data" => $cars]);
        } else {
            echo json_encode(["success" => false, "message" => "No cars found."]);
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
