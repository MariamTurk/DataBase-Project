<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];

    // Validate car ID
    if (empty($car_id)) {
        echo json_encode(["success" => false, "message" => "Car ID is required."]);
        exit();
    }

    // Use a prepared statement to fetch car details
    $stmt = $conn->prepare("SELECT car_id, model, year, mileage, color, transmission, price, status 
                            FROM Cars 
                            WHERE car_id = ?");
    $stmt->bind_param("i", $car_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $car = $result->fetch_assoc();
            echo json_encode(["success" => true, "data" => $car]);
        } else {
            echo json_encode(["success" => false, "message" => "Car not found."]);
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
