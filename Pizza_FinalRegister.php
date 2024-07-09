<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<style>
		body {
			background-color: #f2f2f2;
		}
		form {
			background-color: #fff;
			max-width: 500px;
			margin: 0 auto;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0px 0px 10px #888;
		}
		h2 {
			text-align: center;
			color: #333;
			margin-top: 50px;
			margin-bottom: 30px;
		}
		label {
			display: block;
			margin-bottom: 10px;
			color: #666;
			font-size: 18px;
			font-weight: bold;
		}
		input[type="text"], input[type="email"], input[type="password"] {
			display: block;
			width: 97%;
			padding: 10px;
			border-radius: 3px;
			border: none;
			font-size: 16px;
			margin-bottom: 20px;
		}
		input[type="submit"], input[type="reset"]{
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-size: 18px;
			margin-top: 20px;
			margin-bottom: 10px;
			transition: background-color 0.3s ease-in-out;
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}

		input[type="reset"]:hover {
			background-color: #3e8e41;
		}
	</style>
</head>
<body>
	<h2>Registration Form</h2>
	<form action="Register.php" method="post">
		<label for="idnumber">ID Number:</label>
		<input type="text" id="idnumber" name="idnumber" required>

		<label for="Name">Name:</label>
		<input type="text" id="name" name="name" required>

        <label for="user_type">User Type:</label>
		<select name="user_type" id="user_type" required>
			<option value="">Select User Type</option>
			<option value="1">Admin</option>
			<option value="0">Employee</option>
		</select><br><br>

		<label for="password">Password:</label>
		<input type="password" id="password" name="password" required>

		<label for="password2">Confirm Password:</label>
		<input type="password" id="password2" name="password2" required>

		<input type="submit" name ="submit" value="Register">
		<input type="reset" name ="reset" value="Clear">
	</form>
</body>
</html>

<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $id = $_POST['idnumber'];
    $pass = $_POST['password'];
    $pass2 = $_POST['password2'];
    $role = $_POST['user_type'];

    //Connect to Database
    $con = mysqli_connect("localhost", "root", "", "pizza");

    //Password Validation
    if($pass === $pass2){
		if(strlen($pass) >= 8){
			if(preg_match('/^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}$/', $pass)){
            // Check for duplicate IDs
            $sql="SELECT * FROM REGISTER WHERE IDNUMBER='$id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

				if($row == 0){
					// Insert data
					$sql = "INSERT INTO REGISTER VALUES ('$id', '$name', '$pass', '$role')";
					mysqli_query($con, $sql);

					header("location:RegisterSuccess.php");
				} else {
					echo "<script language='javascript'>
						alert ('Account already exists!');
					</script>";
				}
			}else {
				echo "<script language='javascript'>
					alert('Password must contain at least one uppercase letter, a number, and a special character!');
				</script>";
			}
        // Check password criteria
		} else {
			echo "<script language='javascript'>
				alert('Password must contain at least 8 characters!');
			</script>";
		}
	} else {
		echo "<script language='javascript'>
			alert('Passwords do not match!');
		</script>";
	}
}
?>
