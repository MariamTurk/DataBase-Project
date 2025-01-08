<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];

    if (empty($car_id)) {
        echo json_encode(["success" => false, "message" => "Car ID is required for deletion."]);
        exit();
    }

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM Cars WHERE car_id = ?");
    $stmt->bind_param("i", $car_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Car deleted successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Car not found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error deleting car: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
