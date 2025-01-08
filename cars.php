<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'noem20042003', 'car_management');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the number of sold cars
$soldCars = $conn->query("SELECT COUNT(*) AS count FROM sales")->fetch_assoc()['count'];

// Query to get the number of paid cars
$paidCars = $conn->query("
    SELECT COUNT(*) AS count 
    FROM transactions 
    WHERE status = 'paid'
")->fetch_assoc()['count'];

// Query to get the most paid model
$mostPaidModel = $conn->query("
    SELECT model 
    FROM cars 
    WHERE id = (
        SELECT car_id 
        FROM sales 
        GROUP BY car_id 
        ORDER BY SUM(price) DESC 
        LIMIT 1
    )
")->fetch_assoc()['model'];

// Query to get the total cars and available cars
$totalCars = $conn->query("SELECT COUNT(*) AS count FROM cars")->fetch_assoc()['count'];
$availableCars = $totalCars - $soldCars;

// Return data as JSON
echo json_encode([
    'soldCars' => $soldCars,
    'paidCars' => $paidCars,
    'mostPaidModel' => $mostPaidModel,
    'totalCars' => $totalCars,
    'availableCars' => $availableCars,
]);

// Close connection
$conn->close();
?>
