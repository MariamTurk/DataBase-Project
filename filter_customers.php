<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = isset($_POST['field']) ? $_POST['field'] : null;
    $value = isset($_POST['value']) ? $_POST['value'] : null;

    // Validate inputs
    if (empty($field) || empty($value)) {
        echo json_encode(["success" => false, "message" => "Both field and value are required to filter customers."]);
        exit();
    }

    // Validate the field name
    $allowedFields = ['address'];
    if (!in_array($field, $allowedFields)) {
        echo json_encode(["success" => false, "message" => "Invalid field name for filtering."]);
        exit();
    }

    // Use a prepared statement to fetch customers by the specified field and value
    $stmt = $conn->prepare("SELECT user_id, name, email, phone, address FROM Customers WHERE $field = ?");
    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error preparing query: " . $conn->error]);
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
            echo json_encode(["success" => false, "message" => "No customers found for the specified filter."]);
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
