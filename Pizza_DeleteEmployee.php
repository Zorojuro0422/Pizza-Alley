<!DOCTYPE html>
<html>
<head>
	<title>Delete Product</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}
		h1 {
			text-align: center;
			margin-top: 50px;
			color: #333;
		}
		form {
			margin: 0 auto;
			width: 500px;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
		}
		input[type=text] {
			padding: 10px;
			width: 100%;
			border: none;
			border-radius: 3px;
			margin-bottom: 20px;
			box-sizing: border-box;
		}
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		input[type=submit] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type=submit]:hover {
			background-color: #3e8e41;
		}
		.error {
			color: red;
			font-size: 14px;
			margin-top: 10px;
		}
	</style>
</head>
<body>
	<h1>Delete Product</h1>
	<form method="POST">
		<label for="employeeID">Employee ID:</label>
		 <input type="text" name="employeeID" required><br>
		<input type="submit" name="submit" value="Find Product">
	</form>

	<?php
	// Database Connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pizza";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	// Find Product
	if(isset($_POST['submit'])){
		$employeeID = $_POST['employeeID'];

		// Check if productID exists
		$sql = "SELECT * FROM employee WHERE employeeID='$employeeID'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Product exists, display the product details and confirmation message
			$row = $result->fetch_assoc();
			$employeeName = $row["employeeName"];
			$role = $row["role"];
			if($role == 1){$access = "Admin";}else{$access = "Employee";}

			echo "<form method='POST'>
					<label for='employeeName'>Employee Name:</label>
					<input type='text' name='employeeName' value='$employeeName' readonly><br>
					<label for='access'>Role:</label>
					<input type='text' name='access' value='$access' readonly><br>
					<input type='submit' name='delete' value='Delete Product'>
				</form>";
			} else {
		// Product does not exist
		echo "<p style='text-align:center; color:red'>Product does not exist.</p>";
	}
}

// Delete Product
if(isset($_POST['delete'])){
	$employeeID = $row["employeeID"];

	$sql = "DELETE FROM employee WHERE employeeID='$productID'";

	if ($conn->query($sql) === TRUE) {
		echo "<p style='text-align:center; color:green'>Product deleted successfully</p>";
	} else {
		echo "<p class='error'>Error deleting product: " . $conn->error . "</p>";
	}
}

$conn->close();
?>
