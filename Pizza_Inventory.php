<!DOCTYPE html>
<html>
<head>
	<title>Edit Product Quantity</title>
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
	<h1>Edit Product Quantity</h1>
	<form method="POST">
		<label for="productID">Product ID:</label>
		 <input type="text" name="productID" required><br>
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
		$productID = $_POST['productID'];

		// Check if productID exists
		$sql = "SELECT * FROM products WHERE productID='$productID'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Product exists, display the product details and edit form
			$row = $result->fetch_assoc();
			$productName = $row["productName"];
			$price = $row["price"];

			echo "<form method='POST'>
					<label for='productName'>Product Name:</label>
					<input type='text' name='productName' value='$productName' readonly><br>
					<label for='price'>Price:</label>
					<input type='text' name='price' value='$price' readonly><br>
					<input type='hidden' name='productID' value='$productID'>
					<input type='submit' name='edit' value='Edit Quantity'>";
		}
	}
		
		// Update Product Quantity
		if(isset($_POST['edit'])){
			$productID = $_POST['productID'];
			$quantity = $_POST['quantity'];

			// Update Quantity
			$sql = "UPDATE products SET quantity='$quantity' WHERE productID='$productID'";

			if ($conn->query($sql) === TRUE) {
			  echo "<p style='text-align:center; color:green'>Product quantity updated successfully</p>";
			} else {
			  echo "<p style='text-align:center; color:red'>Product does not exist.</p>";
			}
		}

$conn->close();
?>

			
