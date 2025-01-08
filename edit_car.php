<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_id = $_POST['car_id'];
    $model = isset($_POST['model']) ? $_POST['model'] : null;
    $year = isset($_POST['year']) ? $_POST['year'] : null;
    $mileage = isset($_POST['mileage']) ? $_POST['mileage'] : null;
    $color = isset($_POST['color']) ? $_POST['color'] : null;
    $transmission = isset($_POST['transmission']) ? $_POST['transmission'] : null;
    $price = isset($_POST['price']) ? $_POST['price'] : null;

    if (empty($car_id)) {
        echo json_encode(["success" => false, "message" => "Car ID is required for editing."]);
        exit();
    }

    // Build the SQL query dynamically based on the fields provided
    $fieldsToUpdate = [];
    $params = [];
    $paramTypes = "";

    if ($model) {
        $fieldsToUpdate[] = "model = ?";
        $params[] = $model;
        $paramTypes .= "s";
    }
    if ($year) {
        $fieldsToUpdate[] = "year = ?";
        $params[] = (int)$year;
        $paramTypes .= "i";
    }
    if ($mileage) {
        $fieldsToUpdate[] = "mileage = ?";
        $params[] = (int)$mileage;
        $paramTypes .= "i";
    }
    if ($color) {
        $fieldsToUpdate[] = "color = ?";
        $params[] = $color;
        $paramTypes .= "s";
    }
    if ($transmission) {
        $fieldsToUpdate[] = "transmission = ?";
        $params[] = $transmission;
        $paramTypes .= "s";
    }
    if ($price) {
        $fieldsToUpdate[] = "price = ?";
        $params[] = (float)$price;
        $paramTypes .= "d";
    }

    // Add Car ID for the WHERE clause
    $params[] = (int)$car_id;
    $paramTypes .= "i";

    if (empty($fieldsToUpdate)) {
        echo json_encode(["success" => false, "message" => "No fields to update."]);
        exit();
    }

    // Generate SQL dynamically
    $sql = "UPDATE Cars SET " . implode(", ", $fieldsToUpdate) . " WHERE car_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param($paramTypes, ...$params);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Car updated successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error updating car: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
