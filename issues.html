<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Car Company Management - Issues</title>
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
		<h1>Car Company Management System - Issues</h1>
	</header>

	<main>
		<!-- Issues Section -->
		<h2>Issue Records</h2>

		<!-- Issue Form -->
		<form method="post" action="">
			<label for="issueId">Issue ID:</label> <input type="text"
				id="issueId" name="issueId" required> <label for="carId">Car ID:</label>
			<input type="text" id="carId" name="carId" required> <label
				for="issueType">Issue Type:</label> <input type="text"
				id="issueType" name="issueType" required> <label for="dateReported">Date
				Reported:</label> <input type="date" id="dateReported"
				name="dateReported" required> <label for="description">Description:</label>
			<textarea id="description" name="description" required></textarea>

			<label for="status">Status:</label> <select id="status" name="status"
				required>
				<option value="Open">Open</option>
				<option value="In Progress">In Progress</option>
				<option value="Resolved">Resolved</option>
			</select>

			<button type="submit" name="add">Add</button>
			<button type="submit" name="update">Update</button>
			<button type="submit" name="delete">Delete</button>
			<button type="submit" name="search">Search</button>
		</form>

		<!-- Issue Table -->
		<table id="issueTable">
			<thead>
				<tr>
					<th>Issue ID</th>
					<th>Car ID</th>
					<th>Issue Type</th>
					<th>Date Reported</th>
					<th>Description</th>
					<th>Status</th>
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
                    $issueId = $_POST['issueId'];
                    $carId = $_POST['carId'];
                    $issueType = $_POST['issueType'];
                    $dateReported = $_POST['dateReported'];
                    $description = $_POST['description'];
                    $status = $_POST['status'];

                    $sql = "INSERT INTO Issues (issue_id, car_id, issue_type, issue_date, description, status)
                            VALUES ('$issueId', '$carId', '$issueType', '$dateReported', '$description', '$status')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Issue added successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['update'])) {
                    $issueId = $_POST['issueId'];
                    $carId = $_POST['carId'];
                    $issueType = $_POST['issueType'];
                    $dateReported = $_POST['dateReported'];
                    $description = $_POST['description'];
                    $status = $_POST['status'];

                    $sql = "UPDATE Issues SET car_id='$carId', issue_type='$issueType', issue_date='$dateReported', 
                            description='$description', status='$status' WHERE issue_id='$issueId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Issue updated successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['delete'])) {
                    $issueId = $_POST['issueId'];

                    $sql = "DELETE FROM Issues WHERE issue_id='$issueId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Issue deleted successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['search'])) {
                    $issueId = $_POST['issueId'];

                    $sql = "SELECT * FROM Issues WHERE issue_id='$issueId'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['issue_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['issue_type']}</td>
                                    <td>{$row['issue_date']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['status']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<script>alert('No issues found!');</script>";
                    }
                } else {
                    $sql = "SELECT * FROM Issues";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['issue_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['issue_type']}</td>
                                    <td>{$row['issue_date']}</td>
                                    <td>{$row['description']}</td>
                                    <td>{$row['status']}</td>
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
