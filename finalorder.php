<?php
session_start();

// Check if the user submitted the form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pizza";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add input to current order
if (isset($_POST['add_item'])) {
	$productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    $resultset = $conn->query("SELECT productName, price FROM products WHERE productID = '$productID'") or die($conn->error);

    if ($resultset->num_rows == 0) {
        // Product ID does not exist
        echo "<script>alert('Invalid product ID');</script>";
    } else {
        $row = $resultset->fetch_array();

        // Get productName as item
        $item = $row['productName'];

        // Get price
        $price = $row['price'];

        // Get total
        $total = $quantity * $price;

        $sql = "INSERT INTO current_order (productID, item, quantity, price, total) VALUES ('$productID', '$item', '$quantity', '$price', '$total')";

        mysqli_query($conn, $sql);
    }
}


    // Remove item from current order and delete from database
    if (isset($_POST['remove_item'])) {
        $total = $_POST['total'];

        $sql = "DELETE FROM current_order WHERE total='$total'";
        mysqli_query($conn, $sql);
    }

    if (isset($_POST['placeOrder'])) {
    // Insert into orders table
    $employeeID = $_GET['employeeID'];
	$employeeName = $_GET['employeeName'];
    $mysqli = mysqli_connect('localhost', 'root', '', 'pizza') or die(mysqli_error($mysqli));
    $resultset = $mysqli->query("SELECT SUM(total) AS orderTotal FROM current_order") or die($mysqli->error);
    $row = $resultset->fetch_assoc();
    $orderTotal = $row['orderTotal'];

    $sql = "INSERT INTO orders (employeeID, employeeName, totalSales) VALUES ('$employeeID', '$employeeName', '$orderTotal')";

    if ($mysqli->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Get orderID
    $orderID = $mysqli->insert_id;

    // Get all from current_order
    $resultset = $mysqli->query("SELECT * FROM current_order") or die($mysqli->error);
    while ($row = $resultset->fetch_assoc()) {
        $productID = $row['productID'];
        $productName = $row['item'];
        $quantity = $row['quantity'];
        $total = $row['total'];

        $sql = "INSERT INTO sales (orderID, productID, productName, quantity, total) VALUES ('$orderID', '$productID', '$productName', '$quantity', '$total')";

        mysqli_query($conn, $sql);
    }

    // Empty current_order
    $sql = "DELETE FROM current_order";
    mysqli_query($conn, $sql);
	}
    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/56614d0368.js" crossorigin="anonymous"></script>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>Ordering System</title>
    <style>
				*{
			margin: 0;
			padding: 0;
		}
body {
	
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-image: url(image/bg.jpg);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	color: white;
}
.wrapper{
	display: flex;
	justify-content: space-between;
}
.container{
    position: relative;
    height: 600px;
    width: 40%;
    padding: 10px;
    margin: 72px 10px 10px 10px;

    border: 1px solid rgba(255, 255, 255, .3);
    background: rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
    backdrop-filter: blur(5px);
}
.t_container{
	display: grid;
	place-items: center;
}
.menu{
	display: block;
    height: 600px;
    width: 35%;
	padding: 10px;
    margin: 72px 10px 10px 10px;
    border: 1px solid rgba(255, 255, 255, .3);
    background: rgba(255, 255, 255, 0.3);
    border-radius: 15px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
    backdrop-filter: blur(5px);
	display: grid;
	place-items: center;
	font-size: 23px;	
}
table tr th,td {
	padding-left: 40px;
	border: 2px solid black;
	padding: 8px;
}
.add {
		height: 600px;
		width: 35%;
        display: flex;
		flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px;
        margin: 72px 10px 10px 10px;
        text-align: center;
		 border: 1px solid rgba(255, 255, 255, .3);
		background: rgba(255, 255, 255, 0.3);
		border-radius: 15px;
		box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
		backdrop-filter: blur(5px);
    }

    .add form {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .add label {
        width: 200px;
        display: inline-block;
        text-align: right;
    }

    .add input[type="text"],
    .add input[type="number"] {
        width: 200px;
        padding: 5px;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    .add input[type="submit"] {
        width: 100px;
        padding: 10px;
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
input[type="text"],input[type="number"]{
	border: 2px solid black;
	padding: 8px;
	width: 100px;
	height: 15px;
}
input[type="submit"]{
	width:100px;
	height:45px;
	border: 2px solid black;
}
input[type="submit"]:hover {
  background-color: #aaa;
  transform: scale(1.05);
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

<div class="wrapper">
<div class="menu">

			<?php
				$mysqli = mysqli_connect('localhost', 'root', '', 'pizza') or die(mysqli_error($mysqli));
				$resultset = $mysqli->query("SELECT * FROM products") or die($mysqli->error);
				
				if($resultset -> num_rows > 0){
					
						echo "<table>";
						echo "<tr>";
								echo"<th colspan='3'>MENU</th>";
						echo "</tr>";
						echo "<tr>";
								echo "<th>PRODUCT ID</th>";
								echo "<th>PRODUCT NAME</th>";
								echo "<th>PRIZE</th>";
							echo "</tr>";
						while ($row = $resultset->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["productID"] . "</td>";
							echo "<td>" . $row["productName"] . "</td>";
							echo "<td>" . $row["price"] . "</td>";
							echo "</tr>";
						}echo "</table>";
						} else {
							echo "No data found in the table.";
						}
			?>
</div>

<div class="add">
    <h2>Add Item</h2>

    <form method="post">
        <label for="productID">Product ID:</label>
        <input type="text" id="productID" name="productID"><br><br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" max="10"><br><br>
        <input type="submit" name="add_item" value="Add">
        <input type="submit" name="getTotal" value="Get Total">
        <?php 
        if(isset($_POST['getTotal'])){?>
            <input type="submit" name="placeOrder" value="Place Order">
            <input type="submit" name="cancelOrder" value="Cancel Order">
        <?php
        }
        ?>
        
    </form>
</div>

<div class= "container">
<div class = "t_container">
  <h1>Ordering System</h1>

    <h2>Current Order</h2>
    <table>
        <thead>
            <tr>
                <th>PRODUCT ID</th>
                <th>ITEM</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
                <th>TOTAL</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $mysqli = mysqli_connect('localhost', 'root', '', 'pizza') or die(mysqli_error($mysqli));
            $resultset = $mysqli->query("SELECT * FROM current_order") or die($mysqli->error);

            // Display Order Queue
            while ($row = $resultset->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['productID'] ?></td>
                <td><?php echo $row['item'] ?></td>
                <td><?php echo $row['quantity'] ?></td>
                <td><?php echo $row['price'] ?></td>
                <td><?php echo $row['total'] ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="total" value="<?php echo $row['total']; ?>">
                        <input type="submit" name="remove_item" value="Remove">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
            <?php
            // Calculate and display the total
            if (isset($_POST['getTotal'])) {
                $resultset = $mysqli->query("SELECT SUM(total) AS orderTotal FROM current_order") or die($mysqli->error);
                $row = $resultset->fetch_assoc();
                $orderTotal = $row['orderTotal'];
            ?>
            <tr>
                <td><b>TOTAL: </b></td>
                <td colspan="5"><?php echo $orderTotal; ?></td>
            </tr>
            <?php
            }
            session_destroy();
            ?>
        </tbody>
    </table>
</div>
</div>
</div>
</body>
</html>
