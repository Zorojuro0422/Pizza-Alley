<?php
session_start();
?>
<html>
<head>
<link rel="icon" href="favicon.ico">
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

	<title>Admin Menu</title>
	<style>
		 body {
            background: url('image/2pizza.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: grid;
            place-items: center;
        }

        .container {
            color: white;
            margin-top: 80px;
            display: grid;
            margin-top:5%;
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
		.btn-group {
			margin: 0 auto;
			display: block;
			width: 300px;
		}
		button {
			background-color: #7A3E3E;
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
	<h1>Admin Menu</h1>
	<div class="btn-group">
		<a href="finalorder.php?employeeID=<?php echo $_SESSION["employeeID"]; ?>& employeeName=<?php echo $_SESSION["employeeName"]; ?>"><button>Process Order</button></a>
		<a href="Pizza_AddProduct.php"><button>Add New Product</button></a>
		<a href="Pizza_UpdatePrice.php"><button>Update Product Price</button></a>
		<a href="Pizza_DeleteProduct.php"><button>Delete Product</button></a>
		<a href="Pizza_UpdateEmployee.php"><button>Update Employee Account</button></a>
		<a href="Pizza_Registration.php"><button>Register New Employee</button></a>
	</div>
	</div>
</body>
</html>