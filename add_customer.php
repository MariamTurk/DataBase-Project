<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json'); // Ensures the response is JSON

include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect input data
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Validate required fields
    if (empty($user_id) || empty($name) || empty($email)) {
        echo json_encode(["success" => false, "message" => "User ID, Name, and Email are required."]);
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO Customers (user_id, name, email, phone, address)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $name, $email, $phone, $address);

    // Execute and handle success/failure
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Customer added successfully!"]);
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
