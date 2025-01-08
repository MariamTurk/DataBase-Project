<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST values
    $column = isset($_POST['column']) ? $_POST['column'] : null;
    $value = isset($_POST['value']) ? $_POST['value'] : null;

    // Validate input
    if (!$column || !$value) {
        echo json_encode(["success" => false, "message" => "Both column and value are required."]);
        exit();
    }

    // Allowed columns for security
    $allowedColumns = ['insurance_id', 'car_id', 'customer_id', 'policy_details', 'expiry_date'];
    if (!in_array($column, $allowedColumns)) {
        echo json_encode(["success" => false, "message" => "Invalid column name."]);
        exit();
    }

    // Prepare and execute the query for an exact match
    $stmt = $conn->prepare("SELECT insurance_id, car_id, customer_id, policy_details, expiry_date 
                            FROM Insurance 
                            WHERE $column = ?");
    $stmt->bind_param("s", $value);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $insuranceRecords = [];
        while ($row = $result->fetch_assoc()) {
            $insuranceRecords[] = $row; // Collect the insurance records
        }

        if (count($insuranceRecords) > 0) {
            echo json_encode(["success" => true, "data" => $insuranceRecords]);
        } else {
            echo json_encode(["success" => false, "message" => "No insurance records found."]);
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
