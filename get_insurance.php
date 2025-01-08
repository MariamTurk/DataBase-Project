<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Set the content type to JSON
header('Content-Type: application/json');

// Include the database connection
include 'db_connect.php'; // Ensure this file has the database connection logic

// Check if the database connection is successful
if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    ]);
    exit();
}

// Query to fetch all insurance records
$query = "
    SELECT 
        insurance_id,
        car_id,
        customer_id,
        policy_details,
        expiry_date
    FROM Insurance
";

$result = $conn->query($query);

if ($result) {
    // Array to store all insurance records
    $insurance_records = [];

    // Loop through each record and add to the array
    while ($row = $result->fetch_assoc()) {
        $insurance_records[] = $row;
    }

    // Return success response with data
    echo json_encode([
        "success" => true,
        "data" => $insurance_records
    ]);
} else {
    // Return error response if the query fails
    echo json_encode([
        "success" => false,
        "message" => "Failed to fetch insurance records."
    ]);
}

// Close the database connection
$conn->close();
?>
