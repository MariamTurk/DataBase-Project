<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $column = isset($_POST['column']) ? $_POST['column'] : null;
    $value = isset($_POST['value']) ? $_POST['value'] : null;

    // Log received data to debug.log
    file_put_contents('debug.log', "Received column: $column, value: $value\n", FILE_APPEND);

    if (empty($column) || empty($value)) {
        echo json_encode(["success" => false, "message" => "Search type and value are required."]);
        exit();
    }

    // Validate the column name
    $allowedColumns = ['user_id', 'name', 'email', 'phone'];
    if (!in_array($column, $allowedColumns)) {
        echo json_encode(["success" => false, "message" => "Invalid column name."]);
        exit();
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT user_id, name, email, phone, address FROM Customers WHERE $column = ?");
    if (!$stmt) {
        // Log error if query preparation fails
        file_put_contents('debug.log', "Failed to prepare query: " . $conn->error . "\n", FILE_APPEND);
        echo json_encode(["success" => false, "message" => "Error preparing query."]);
        exit();
    }

    $stmt->bind_param("s", $value);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $customers = [];
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }

        if (count($customers) > 0) {
            echo json_encode(["success" => true, "data" => $customers]);
        } else {
            echo json_encode(["success" => false, "message" => "No customers found."]);
        }
    } else {
        // Log error if query execution fails
        file_put_contents('debug.log', "Failed to execute query: " . $stmt->error . "\n", FILE_APPEND);
        echo json_encode(["success" => false, "message" => "Error executing query."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
