<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Car Company Management - Maintenance</title>
</head>
<style>

/* General styles */
body {
	font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	margin: 0;
	padding: 0;
	background-color: #f9f9f9;
	color: #333;
}

input[type="text"], input[type="date"], select, textarea {
	width: 200px; /* Set the width of text input fields */
	padding: 8px;
	margin: 8px 0;
	box-sizing: border-box; /* Ensures padding is included in width */
}

textarea {
	width: 200px; /* Set width of textarea */
	height: 100px; /* Optional: adjust the height of the textarea */
}

button {
	padding: 8px 16px;
	margin-top: 10px;
	cursor: pointer;
}

header {
	color: black;
	text-align: center;
	padding: 20px 0;
}

main {
	margin: 20px;
}

h1, h2 {
	text-align: center;
}

h2 {
	margin-top: 40px;
	color: #000;
}

/* Form styles */
form {
	display: flex;
	flex-wrap: wrap;
	gap: 10px;
	align-items: center;
	background: #fff;
	padding: 10px;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	border-radius: 8px;
}

form label, form input, form select, form textarea {
	display: inline-block;
	width: auto;
	margin-right: 10px;
	font-size: 14px;
}

form button {
	width: auto;
	margin-top: 10px;
	align-self: flex-start;
}

form button:hover {
	background-color: #333;
}

/* Table styles */
table {
	width: 100%;
	margin: 20px 0;
	border-collapse: collapse;
	background: #fff;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	border-radius: 8px;
	overflow: hidden;
}

table th, table td {
	padding: 12px;
	text-align: left;
	border-bottom: 1px solid #ddd;
}

table th {
	background-color: #000;
	color: white;
	font-weight: bold;
}

table tbody tr:hover {
	background-color: #f1f1f1;
}

/* Footer styles */
footer {
	text-align: center;
	padding: 10px 0;
	background-color: #000;
	color: white;
	margin-top: 40px;
}

.navbar {
	background-color: rgba(0, 0, 0, 0.8);
	overflow: hidden;
	display: flex;
	padding: 10px;
}

.navbar a {
	color: white;
	text-decoration: none;
	padding: 14px 20px;
	margin: 0 10px;
}

.navbar a:hover {
	background-color: #575757;
	border-radius: 5px;
}

#description {
	width: 100%;
	height: auto; /* Auto adjust based on content */
	max-height: 40px; /* Limiting the height */
	font-size: 14px; /* Smaller text size */
}

/* Responsive styles */
@media ( max-width : 768px) {
	form label, form input, form select, form textarea, form button {
		width: 100%;
	}
}
</style>
<body>
	<div class="navbar">
		<a href="customers.html">Customers</a> <a href="cars.html">Cars</a> <a
			href="sales.html">Sales</a> <a href="transactions.html">Transactions</a>
		<a href="payment-plans.html">Payment Plans</a> <a
			href="insurance.html">Insurance</a> <a href="maintenance.html">Maintenance</a>
		<a href="feedback.html">Feedback</a> <a href="issues.html">Issues</a>
	</div>

	<header>
		<h1>Car Company Management System - Maintenance</h1>
	</header>

	<main>
		<!-- Maintenance Section -->
		<h2>Maintenance Records</h2>
		<form method="post" action="">
			<label for="maintenanceId">Maintenance ID:</label> <input type="text"
				id="maintenanceId" name="maintenanceId" required> <label for="carId">Car
				ID:</label> <input type="text" id="carId" name="carId" required> <label
				for="type">Type:</label> <input type="text" id="type" name="type"
				required> <label for="date">Date:</label> <input type="date"
				id="date" name="date" required> <label for="cost">Cost:</label> <input
				type="number" id="cost" name="cost" step="0.01" required> <label
				for="serviceCenter">Service Center:</label> <input type="text"
				id="serviceCenter" name="serviceCenter" required>

			<button type="submit" name="add">Add</button>
			<button type="submit" name="update">Update</button>
			<button type="submit" name="delete">Delete</button>
			<button type="submit" name="search">Search</button>
		</form>

		<table id="maintenanceTable">
			<thead>
				<tr>
					<th>Maintenance ID</th>
					<th>Car ID</th>
					<th>Type</th>
					<th>Date</th>
					<th>Cost</th>
					<th>Service Center</th>
				</tr>
			</thead>
			<tbody>
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'pp');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_POST['add'])) {
                    $maintenanceId = $_POST['maintenanceId'];
                    $carId = $_POST['carId'];
                    $type = $_POST['type'];
                    $date = $_POST['date'];
                    $cost = $_POST['cost'];
                    $serviceCenter = $_POST['serviceCenter'];

                    $sql = "INSERT INTO Maintenance (maintenance_id, car_id, maintenance_type, maintenance_date, cost, service_center)
                            VALUES ('$maintenanceId', '$carId', '$type', '$date', '$cost', '$serviceCenter')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Maintenance record added successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['update'])) {
                    $maintenanceId = $_POST['maintenanceId'];
                    $carId = $_POST['carId'];
                    $type = $_POST['type'];
                    $date = $_POST['date'];
                    $cost = $_POST['cost'];
                    $serviceCenter = $_POST['serviceCenter'];

                    $sql = "UPDATE Maintenance SET car_id='$carId', maintenance_type='$type', maintenance_date='$date', 
                            cost='$cost', service_center='$serviceCenter' WHERE maintenance_id='$maintenanceId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Maintenance record updated successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['delete'])) {
                    $maintenanceId = $_POST['maintenanceId'];

                    $sql = "DELETE FROM Maintenance WHERE maintenance_id='$maintenanceId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Maintenance record deleted successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['search'])) {
                    $maintenanceId = $_POST['maintenanceId'];

                    $sql = "SELECT * FROM Maintenance WHERE maintenance_id='$maintenanceId'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['maintenance_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['maintenance_type']}</td>
                                    <td>{$row['maintenance_date']}</td>
                                    <td>{$row['cost']}</td>
                                    <td>{$row['service_center']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<script>alert('No maintenance record found!');</script>";
                    }
                } else {
                    $sql = "SELECT * FROM Maintenance";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['maintenance_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['maintenance_type']}</td>
                                    <td>{$row['maintenance_date']}</td>
                                    <td>{$row['cost']}</td>
                                    <td>{$row['service_center']}</td>
                                  </tr>";
                        }
                    }
                }

                $conn->close();
                ?>
            </tbody>
		</table>
	</main>

	<footer>
		<p>&copy; 2025 Car Company Management. All rights reserved.</p>
	</footer>
</body>
</html>
