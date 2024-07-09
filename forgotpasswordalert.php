<!DOCTYPE html>
<html>
<head>
    <title>Employee Password</title>
    <title>Forgot Password</title>
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
    <style>
         body {
            background: url('image/login_photo.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: grid;
            place-items: center;
        }
        .login {
            margin-top; 16px;
        }

        .container {
            color: white;
            display: grid;
            margin-top:7%;
            margin-right:12%;
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
  .myButton {
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
	background-color:#ededed;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#525252;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:linear-gradient(to bottom, #dfdfdf 5%, #ededed 100%);
	background-color:#dfdfdf;
}
.myButton:active {
	position:relative;
	top:1px;
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
        .forgot{
            color: brown;
            margin-bottom: 3%;
        
            
        }
       .forgot:hover{
        color: #fff;
       }
       .employee{
        margin-bottom: 16px;
       }
.myButton {
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
	background-color:#ededed;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#525252;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background:linear-gradient(to bottom, #dfdfdf 5%, #ededed 100%);
	background-color:#dfdfdf;
}
.myButton:active {
	position:relative;
	top:1px;
}
       h3{
        margin-bottom:0;
       }
       .square{
        border-radius: 6px;
        margin-top:5%;
        margin-bottom:5%;
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
    <h2>Forgot Password</h2>
    <form method="POST" action="">
      <div class="login">
        <label class="employee" for="employeeID">Enter Employee ID</label>
        <input class="square" type="text" id="employeeID" name="employeeID">
      </div>
        <button class="myButton" type="submit">Get Password</button>
    </form>
    <a class="forgot" href="Pizza_Login.php">Go Back</a>
      </div>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "pizza");
    if (!$conn) {
        die("Connection failed: " . mysqli_con_error());
    }

    if (isset($_POST['employeeID'])) {
        $employeeID = $_POST['employeeID'];
        $sql = "SELECT password FROM employee WHERE employeeID = '$employeeID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $password = $row['password'];
            echo '<script>alert("Your Password Is: ' . $password . '");</script>';
        } else {
            echo '<script>alert("No employee found with the provided ID.");</script>';
        }
    }


    $conn->close();
    ?>
</body>
</html>
