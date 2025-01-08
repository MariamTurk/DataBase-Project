<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'];

    // Validate the status input
    if (empty($status)) {
        echo json_encode(["success" => false, "message" => "Status is required to filter cars."]);
        exit();
    }

    // Use a prepared statement to fetch cars by status
    $stmt = $conn->prepare("SELECT car_id, model, year, mileage, color, transmission, price, status 
                            FROM Cars 
                            WHERE status = ?");
    $stmt->bind_param("s", $status);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $cars = [];
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        if (count($cars) > 0) {
            echo json_encode(["success" => true, "data" => $cars]);
        } else {
            echo json_encode(["success" => false, "message" => "No cars found with the status '$status'."]);
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
