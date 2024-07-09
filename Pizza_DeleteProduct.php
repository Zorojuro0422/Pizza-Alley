<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="favicon.ico">
  <title>Pizza on Valley</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/56614d0368.js" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	<title>Delete Product</title>
	<style>
		 body {
            background: url('image/2pizza.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: grid;
            place-items: center;
        }
		.container {
            margin-top: 80px;
            display: grid;
            margin-top:7%;
            text-align: center;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .3);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
            backdrop-filter: invert(1px);
            height: 600px;
            width: 25%;
            font-size: 1.5em;
        }
		form{
			margin-bottom: 75%;
		}
		input[type=text] {
			height: 50%;
			width: 80%;
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
			background-color: #7A3E3E;
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


	<div class="container">
		<h1>Delete Product</h1>
		<form method="POST">
		<label for="productID">Product ID:</label>
		 <input type="text" name="productID" required><br>
		<input type="submit" name="submit" value="Find Product">
	</form>
	</div>
	

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
			// Product exists, display the product details and confirmation message
			$row = $result->fetch_assoc();
			$productName = $row["productName"];
			$price = $row["price"];

			echo "<form method='POST'>
					<label for='productName'>Product Name:</label>
					<input type='text' name='productName' value='$productName' readonly><br>
					<label for='price'>Price:</label>
					<input type='text' name='price' value='$price' readonly><br>
					<input type='hidden' name='productID' value='$productID'>
					<input type='submit' name='delete' value='Delete Product'>
				</form>";
			} else {
		// Product does not exist
		echo "<p style='text-align:center; color:red'>Product does not exist.</p>";
	}
}

// Delete Product
if(isset($_POST['delete'])){
	$productID = $_POST['productID'];

	$sql = "DELETE FROM products WHERE productID='$productID'";

	if ($conn->query($sql) === TRUE) {
		echo "<p style='text-align:center; color:green'>Product deleted successfully</p>";
	} else {
		echo "<p class='error'>Error deleting product: " . $conn->error . "</p>";
	}
}

$conn->close();
?>
