<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xxx" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/56614d0368.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <title>Registration Form</title>
    <style>
        body {
            background: url('image/2pizza.jpeg') no-repeat center center fixed;
            background-size: cover;
            display: grid;
            place-items: center;
        }

        .container {
            display: grid;
            margin-top: 7%;
            text-align: center;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .3);
            background: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
            backdrop-filter: invert(1px);
            height: 80%;
            width: 25%;
            font-size: 1.5em;
        }

        select {
            display: inline;
            font-size: 18px;
            font-weight: bold;
            border-radius: 3px;
        }

        form {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            display: block;
            width: 97%;
            border-radius: 3px;
            border: none;
            font-size: 16px;
        }

        input[type="submit"],
        input[type="reset"] {
            margin-top: 32px;
            background-color: #7A3E3E;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 18px;
            margin-bottom: 10px;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
            margin-right: auto;
            margin-left: auto;
        }

        input[type="reset"]:hover {
            background-color: #3e8e41;
            margin-right: auto;
            margin-left: auto;
        }

        .word {
            color: white;
            font-size: 1.3rem;
        }

        .word:hover {
            color: yellow;
        }

        .home {
            margin-right: 48px;
        }

        .navbar-brand {
            margin-left: 48px;
        }

        .typee {
            margin-top: 16px;
        }

        .password-check {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }

        .checkmark {
            color: green;
        }

        .xmark {
            color: red;
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
    <h2>Registration Form</h2>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <label for="idnumber">ID Number:</label>
        <input type="text" id="idnumber" name="idnumber" required>

        <label for="First Name">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="Last Name">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>

        <select class="typee" name="user_type" id="user_type" required>
            <option value="">Select User Type</option>
            <option value="1">Admin</option>
            <option value="0">Employee</option>
        </select><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="password2">Confirm Password:</label>
        <input type="password" id="password2" name="password2" required>
        <div class="password-check">
            <i class="fas fa-check-circle checkmark" style="display: none;"></i>
            <i class="fas fa-times-circle xmark" style="display: none;"></i>
        </div>

        <input type="submit" name ="submit" value="Register">
        <input type="reset" name ="reset" value="Clear">

    </form>
    </div>
    
    <!-- JavaScript -->
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password2');
        const checkmarkIcon = document.querySelector('.checkmark');
        const xmarkIcon = document.querySelector('.xmark');

        confirmPasswordInput.addEventListener('keyup', () => {
            if (passwordInput.value === confirmPasswordInput.value) {
                checkmarkIcon.style.display = 'inline';
                xmarkIcon.style.display = 'none';
            } else {
                checkmarkIcon.style.display = 'none';
                xmarkIcon.style.display = 'inline';
            }
        });

        <?php if (isset($registration_success) && $registration_success): ?>
            alert('Registration successful!');
        <?php endif; ?>
    </script>
</body>
</html>


<?php
ob_start();
if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $id = $_POST['idnumber'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $role = $_POST['user_type'];

    $fname = $firstname;
    $lname = $lastname;

    // Firstname must not be empty or contain only whitespace
    if (trim($fname) === '') {
        echo "<script>
		alert('First name must not be empty or contain only whitespace!');
		</script>";
    } else {

        // Lastname must not be empty or contain only whitespace
        if (trim($lname) === '') {
            echo "<script>
			alert('Last name must not be empty or contain only whitespace!');
			</script>";
        } else {

            // concatenate first & last name
            $name = $firstname . " " . $lastname;

            //Database Connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pizza";

            $con = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error($con));

            //Check for duplicate IDs
            $sql = "SELECT * FROM EMPLOYEE WHERE EMPLOYEEID='$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 0) {

                //Check if password inputs match
                if ($pass === $pass2) {

                    //Check password length
                    if (preg_match('/^.{8,}/', $pass)) {

                        //Check if pass contains an uppercase letter
                        if (preg_match('/[A-Z]/', $pass)) {

                            //Check if pass contains a lowercase letter
                            if (preg_match('/[a-z]/', $pass)) {

                                //Check if pass contains a number
                                if (preg_match('/\d/', $pass)) {

                                    //Check if pass contains a special character
                                    if (preg_match('/[^a-zA-Z0-9]/', $pass)) {

                                        // Insert data
                                        $sql = "INSERT INTO EMPLOYEE VALUES ('$id', '$name', '$pass', '$role')";
                                        if (mysqli_query($con, $sql)) {
                                        echo "<script>alert('Registration successful!');</script>";
                                        } else {
                                         echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
                                        }
                                    } else {
                                        echo "<script>
										alert ('Password must be a combination of uppercase and lowercase letters, numbers, and special characters!. Lacking special character!');
										</script>";
                                    }
                                } else {
                                    echo "<script>
									alert ('Password must be a combination of uppercase and lowercase letters, numbers, and special characters!. Lacking numerical character!');
									</script>";
                                }
                            } else {
                                echo "<script>
								alert ('Password must be a combination of uppercase and lowercase letters, numbers, and special characters!. Lacking lowercase letter!');
								</script>";
                            }
                        } else {
                            echo "<script>
							alert ('Password must be a combination of uppercase and lowercase letters, numbers, and special characters!. Lacking uppercase letter!');
							</script>";
                        }
                    } else {
                        echo "<script>
						alert ('Password must contain at least 8 characters!');
						</script>";
                    }
                } else {
                    echo "<script>
					alert('Passwords do not match!');
					</script>";
                }
            } else {
                echo "<script>
				alert ('Account already exists!');
				</script>";
            }
        }
    }
}
ob_end_flush();
?>
