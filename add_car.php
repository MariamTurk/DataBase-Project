<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Ensures the response is JSON

include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input data
    $car_id = $_POST['car_id'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $mileage = $_POST['mileage'];
    $color = $_POST['color'];
    $transmission = $_POST['transmission'];
    $price = $_POST['price'];
    $status = 'Available';

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Cars (car_id, model, year, mileage, color, transmission, price, status)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiissds", $car_id, $model, $year, $mileage, $color, $transmission, $price, $status);

    // Execute and handle success/failure
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Car added successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
