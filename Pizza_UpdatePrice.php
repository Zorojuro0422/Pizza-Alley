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

	<title>Update Product Price</title>
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
		h1 {
			text-align: center;
			margin-top: 50px;
			color: #333;
		}
		input[type=text], input[type=number] {
			height: 50%;
			width: 80%;
			border: none;
			border-radius: 3px;
			margin-bottom: 20px;
			box-sizing: border-box;
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
		.word{
  			color:white;
  			font-size:1.3rem;
		}
			.word:hover{
  	 		 color: yellow;
		}
		.home{
  			margin-right:48px;
		}
		.navbar-brand{
   			 margin-left:48px;
		}

	</style>
</head>
<body>
	  <!-- Navigation -->
	  <nav class="navbar navbar-expand-lg bg-transparent navbar-dark navbar fixed-top">
    <a class="navbar-brand" href=""> <img src="image/pizza-loggo.png" style="height: 32px;" alt=""> </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse home" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="Pizza_main.php"><span class="word">Home</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="finalorder.php"> <span class="word">Order</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Pizza_Login.php"><span class="word">Login</span></a>
        </li>
      </ul>
    </div>
  </nav>
		<div class="container">
	<h1>Update Product Price</h1>
	<form method="POST">
		<label for="productID">Product ID:</label>
		<input type="text" name="productID" required><br>

		<label for="price">New Price:</label>
		<input type="number" name="price" required><br>

		<input type="submit" name="submit" value="Update Price">
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

	// Update Product Price
	if(isset($_POST['submit'])){
		$productID = $_POST['productID'];
		$price = $_POST['price'];

		// Check if productID exists
		$sql = "SELECT * FROM products WHERE productID='$productID'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Product exists, update the price
			$sql = "UPDATE products SET price='$price' WHERE productID='$productID'";

			if ($conn->query($sql) === TRUE) {
			  echo "<p style='text-align:center; color:green'>Price updated successfully</p>";
			} else {
			  echo "<p style='text-align:center; color:red'>Error: " . $sql . "<br>" . $conn->error . "</p>";
			}
		} else {
			// Product does not exist
			echo "<p class='error' style='text-align:center;'>Product does not exist</p>";
		}
	}

	// Close Connection
	$conn->close();
	?>
</body
