<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "pizza") or die("Error in connection");
if (isset($_POST['Login'])) {
    $id = $_POST['employeeID'];
    $pwd = $_POST['password'];
    $sql = "SELECT * FROM EMPLOYEE WHERE employeeID='" . $id . "'";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($con)); // Add error handling code here
    }

    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($count == 0) {
        echo "<script language='javascript'>alert('Employee does not exist.');</script>";
    } else if ($row['password'] != $pwd){
        echo "<script language = 'javascript'>alert('Wrong password.');</script>";
    }
    
    else if ($row[3] == 1) {
        $_SESSION['employeeID'] = $row[0];
        $_SESSION['employeeName'] = $row[1];
        header("location: Pizza_Admin.php");
        exit(); // Add an exit statement to prevent further execution
    } else {
        $_SESSION['employeeID'] = $row[0];
        $_SESSION['employeeName'] = $row[1];
        header("location: Pizza_Employee.php");
        exit(); // Add an exit statement to prevent further execution
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .container {
            color: white;
            margin-top: 80px;
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
	background-color:#ededed;
	border-radius:6px;
	border:1px solid #dcdcdc;
	display:inline-block;
	cursor:pointer;
	color:#474747;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:8px 38px;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffffff;
}
.myButton:hover {
	background-color:#dfdfdf;
}
.myButton:active {
	position:relative;
	top:1px;
}

        
        
        .login {
            margin-bottom: 32px;
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
        .acc{
            margin-top:5%;
            height: 120px;
            width: 140px;
        }
        .login_container{
            margin-bottom:27%;
        }
        .forgot{
            color: brown;
        }
       .forgot:hover{
        color: #fff;
       }
       .square{
        border-radius: 6px;
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
        <img class ="acc" src="image/acc.png" alt="acc">
        <form action="" method="POST" class="login_container">    
            <div class="login">
                <label>Account ID</label>
                <input class="square" type="text" name="employeeID" required>
            </div>

            <div class="login">
                <label>Password</label>
                <input  class="square" type="password" name="password" required>
            </div>
            <div class="login ">
                <input class="myButton"type="submit" value="Login" name="Login">
            </div>
            <a href="forgotpasswordalert.php" class="forgot">Forgot Password</a>
        </form>
    </div>
</body>

</html>