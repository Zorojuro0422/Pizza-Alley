<!DOCTYPE html>
<html>
<head>
	<title>Employee Menu</title>
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
		.btn-group {
			margin: 0 auto;
			display: block;
			width: 300px;
		}
		button {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
			display: block;
			margin-bottom: 10px;
			width: 100%;
			text-align: left;
		}
		button:hover {
			background-color: #3e8e41;
		}
		
		a:link{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<h1>Employee Menu</h1>
	<div class="btn-group">
		<a href="Pizza_Order.php"><button>Process Order</button></a>
		<a href="Pizza_Inventory.php"><button>Manage Inventory</button></a>
	</div>
</body>
</html>
