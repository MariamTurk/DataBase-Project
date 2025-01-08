<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
		<h1>Car Company Management System - Customer Feedback</h1>
	</header>


	<main>
		<!-- Feedback Section -->
		<h2>Customer Feedback</h2>
		<form method="post" action="">
			<label for="feedbackId">Feedback ID:</label> <input type="text"
				id="feedbackId" name="feedbackId" required> <label for="customerId">Customer
				ID:</label> <input type="text" id="customerId" name="customerId"
				required> <label for="carIdFeedback">Car ID:</label> <input
				type="text" id="carIdFeedback" name="carIdFeedback" required> <label
				for="feedbackDate">Date:</label> <input type="date"
				id="feedbackDate" name="feedbackDate" required> <label for="rating">Rating:</label>
			<input type="number" id="rating" name="rating" min="1" max="5"
				required> <label for="comments">Comments:</label>
			<textarea id="comments" name="comments" rows="2"></textarea>
			<button type="submit" name="add">Add</button>
			<button type="submit" name="update">Update</button>
			<button type="submit" name="delete">Delete</button>
			<button type="submit" name="search">Search</button>
		</form>

		<table id="feedbackTable">
			<thead>
				<tr>
					<th>Feedback ID</th>
					<th>Customer ID</th>
					<th>Car ID</th>
					<th>Date</th>
					<th>Rating</th>
					<th>Comments</th>
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
                    $feedbackId = $_POST['feedbackId'];
                    $customerId = $_POST['customerId'];
                    $carId = $_POST['carIdFeedback'];
                    $feedbackDate = $_POST['feedbackDate'];
                    $rating = $_POST['rating'];
                    $comments = $_POST['comments'];

                    $sql = "INSERT INTO Feedback (feedback_id, customer_id, car_id, feedback_date, rating, comments)
                            VALUES ('$feedbackId', '$customerId', '$carId', '$feedbackDate', '$rating', '$comments')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Feedback added successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['update'])) {
                    $feedbackId = $_POST['feedbackId'];
                    $customerId = $_POST['customerId'];
                    $carId = $_POST['carIdFeedback'];
                    $feedbackDate = $_POST['feedbackDate'];
                    $rating = $_POST['rating'];
                    $comments = $_POST['comments'];

                    $sql = "UPDATE Feedback SET customer_id='$customerId', car_id='$carId', feedback_date='$feedbackDate', 
                            rating='$rating', comments='$comments' WHERE feedback_id='$feedbackId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Feedback updated successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['delete'])) {
                    $feedbackId = $_POST['feedbackId'];

                    $sql = "DELETE FROM Feedback WHERE feedback_id='$feedbackId'";

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Feedback deleted successfully!');</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                if (isset($_POST['search'])) {
                    $feedbackId = $_POST['feedbackId'];

                    $sql = "SELECT * FROM Feedback WHERE feedback_id='$feedbackId'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['feedback_id']}</td>
                                    <td>{$row['customer_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['feedback_date']}</td>
                                    <td>{$row['rating']}</td>
                                    <td>{$row['comments']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<script>alert('No feedback found!');</script>";
                    }
                } else {
                    $sql = "SELECT * FROM Feedback";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['feedback_id']}</td>
                                    <td>{$row['customer_id']}</td>
                                    <td>{$row['car_id']}</td>
                                    <td>{$row['feedback_date']}</td>
                                    <td>{$row['rating']}</td>
                                    <td>{$row['comments']}</td>
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