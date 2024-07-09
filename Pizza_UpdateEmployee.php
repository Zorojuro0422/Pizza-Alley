<!DOCTYPE html>
<html>
<head>
	<title>Update Employee</title>

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
            max-height: 900px;
            font-size: 1.5em;
			max-width: 700px;
			padding:32px;
        }
	
		table {
			border-collapse: collapse;
			margin: auto;
			width: 100%;
		}
		th, td {
			border: 1px solid black;
			padding: 8px;
			text-align: center;
		}
		
		th {
			background-color: #f2f2f2;
		}

		form {
			border-radius: 5px;
			box-shadow: 0px 0px 10px #888;
			background: rgba(255, 255, 255, 0.3);
			box-shadow: 0 4px 30px rgba(0, 0, 0, .3);
			backdrop-filter: invert(1px);
			max-width: 700px;
			margin: 0 auto;
			margin-bottom: 20px;
			padding: 20px;
		}
		input[type=text] {
			height: 50%;
			width: 90%;
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
			font-size: 16px;
			margin-top: 10px;
			text-align: center;
		}

		.success {
			color: green;
			font-size: 16px;
			margin-top: 10px;
			text-align: center;
		}
		td{
			font-size:16px;
		}
		th{
			padding:0px;
		}
		.table_container{
			width:70%;
		
		}
		.New_Employee{
			padding:24px;
		}
		.editt{
			margin-top: 24px;
			margin-left:20px;
			margin-right:20px;
		}
	</style>
</head>
<body>


<?php
//Start session
session_start();

// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";

$con = mysqli_connect($servername, $username, $password, $dbname) or die(mysqli_error($con));
?>

<div class="container">
<h1>Update Employee</h1>
	<form method="POST">
		<label for="employeeID">Employee ID:</label>
		<input type="text" id="employeeID" name="employeeID" required><br>

		<!--Check ID format-->
		<script>
		const id = document.getElementById('employeeID');

		id.addEventListener('input', function() {
			const inputValue = id.value;

			//remove if not number
			const cleanValue = inputValue.replace(/[^\d]/g, '');

			//Strict format
			let formattedValue = '';
			if (cleanValue.length > 0) {
			formattedValue = cleanValue.slice(0, 2) + '-' + cleanValue.slice(2, 6) + '-' + cleanValue.slice(6, 9);
			}

			//update value to formatted value
			id.value = formattedValue;
		});
		</script>
		<input type="submit" name="findEmployee" value="Find Employee">
	</form>

<?php
if (isset($_POST['findEmployee'])) {
	$employeeID = $_POST['employeeID'];

	// Check if EmployeeID exists
	$sql = "SELECT * FROM employee WHERE employeeID='$employeeID'";
	$resultset = mysqli_query($con, $sql);

	if (mysqli_num_rows($resultset) > 0) {

		// Display the Employee details
		$row = mysqli_fetch_assoc($resultset);
		$employeeName = $row["employeeName"];
		$role = $row["role"];

		if ($role == 1) {
			$access = "Admin";
		} else {
			$access = "Employee";
		}

    $_SESSION['employeeID'] = $employeeID;
	$_SESSION['employeeName'] = $employeeName;
?>

		<form class="New_Employee" method='POST'>
			<label for='newName'>New Employee Name:</label>
			<input type='text' name='newName' value='<?php echo $employeeName; ?>' required><br>
			<label for='newRole'>New Role:</label>
			<select name='newRole' required>
				<option value='1'>Admin</option>
				<option value='2'>Employee</option>
			</select><br>
			<input type='hidden' name='employeeID' value='<?php echo $employeeID; ?>'>
			<input type='submit' name='delete' value='Delete Employee'>
			<input type='submit' class="editt" name='editName' value='Edit Employee Name'>
			<input type='submit' name='editRole' value='Edit Employee Role'>
		</form>

<?php
	} else {

		// Employee does not exist
		echo "<p class='error'>Employee Account does not exist.</p>";
	}
}

// Update Employee Name
if (isset($_POST['editName'])) {
	$employeeID = $_POST['employeeID'];
	$newName = $_POST['newName'];

	$_SESSION['employeeID'] = $employeeID;
	$_SESSION['newName'] = $newName;
?>
	<h1>Update Employee Details Confirmation</h1>
	<p>Are you sure you want to update Employee Name to <?php echo $newName; ?>?</p>
    
	<form method="post">
		<input type="submit" name="confirm1" id="confirm1" value="Yes, Update">
	</form>

<?php
}

// Update Employee Role
if (isset($_POST['editRole'])) {
	$employeeID = $_POST['employeeID'];
	$newRole = $_POST['newRole'];

	$_SESSION['employeeID'] = $employeeID;
	$_SESSION['newRole'] = $newRole;
?>
	<h1>Update Employee Details Confirmation</h1>
	<p>Are you sure you want to update Employee Role to <?php echo ($newRole == 1) ? "Admin" : "Employee"; ?>?</p>
    
	<form method="post">
		<input type="submit" name="confirm2" id="confirm2" value="Yes, Update">
	</form>

<?php
}

// Delete Employee
if (isset($_POST['delete'])) {
	$employeeID = $_POST['employeeID'];
	$employeeName = $_SESSION['employeeName'];

	$_SESSION['employeeID'] = $employeeID;
	$_SESSION['employeeName'] = $employeeName;
?>
	<h1>Delete Employee Confirmation</h1>
    <p>Are you sure you want to delete Employee Name: <?php echo $employeeName; ?>, Employee ID: <?php echo $employeeID; ?>?</p>
    
    <form method="post">
        <input type="submit" name="confirm3" id ="confirm3" value="Yes, Delete">
    </form>

<?php
}

if (isset($_POST['confirm1'])) {
	$employeeID = $_SESSION['employeeID'];
	$newName = $_SESSION['newName'];

	$sql = "UPDATE employee SET employeeName ='$newName' WHERE employeeID='$employeeID'";

	mysqli_query($con, $sql) or die(mysqli_error($con));

	if (mysqli_affected_rows($con) > 0) {
		echo "<p class='success'>Employee Account updated successfully</p>";
	} else {
		echo "<p class='error'>Error updating Employee: No records affected</p>";
	}
}

if (isset($_POST['confirm2'])) {
	$employeeID = $_SESSION['employeeID'];
	$newRole = $_SESSION['newRole'];

	$sql = "UPDATE employee SET role ='$newRole' WHERE employeeID='$employeeID'";

	mysqli_query($con, $sql) or die(mysqli_error($con));

	if (mysqli_affected_rows($con) > 0) {
		echo "<p class='success'>Employee Account updated successfully</p>";
	} else {
		echo "<p class='error'>Error updating Employee: No records affected</p>";
	}
}

if (isset($_POST['confirm3'])) {
    $employeeID = $_SESSION['employeeID'];

    $sql = "DELETE FROM employee WHERE employeeID='$employeeID'";

    mysqli_query($con, $sql) or die(mysqli_error($con));

    if (mysqli_affected_rows($con) > 0) {
        echo "<p class='success'>Employee Account deleted successfully</p>";
    } else {
        echo "<p class='error'>Error deleting Employee: No records affected</p>";
    }
}

// Display table of all employees
$sql = "SELECT employeeID, employeeName, role FROM employee";
$resultset = mysqli_query($con, $sql);

if (!$resultset) {
	die("Failure to execute Query: " . mysqli_error($con));
}
?>
<div class="table_container">
<table>
	<thead >
		<tr>
			<th>EMPLOYEE ID</th>
			<th>EMPLOYEE NAME</th>
			<th>EMPLOYEE ROLE</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($row = mysqli_fetch_assoc($resultset)): ?>
			<tr>
				<td><?php echo $row['employeeID'] ?></td>
				<td><?php echo $row['employeeName'] ?></td>
				<td><?php echo ($row['role'] == 1) ? "Admin" : "Employee"; ?></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>
</div>
</div>

<?php
// Close connection
mysqli_close($con);
?>

</body>
</html>
