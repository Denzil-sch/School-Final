<!--This will not show up until the user is logged in. It should show all information the user 
    entered when they registered so it will need to pull it from the database and display-->

<?PHP
//start the session to carry over user input
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Student Portal</title>
	<style>
		.ul {
			list-style-type: none; margin: 0; padding: 0; overflow: hidden; background-color: blue;
		}
		body {
			background-color: white; text-align: center;
		}
		.header {
			background-color: crimson; color: white; text-align: center;
		}
		li {
			float: left;
		}
		li a {
			display: inline-block; padding: 20px 20px; color: white;
		}
	</style>
	
	<body>
		<div class="header">
			<h1>Welcome to the Profile Page</h1>
		</div>
		
		<div class="ul">
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>LOGOUT</a></li>
			<li style="float:right"><a href="profile.php"><span class="glyphicon glyphicon-cog"></span>PROFILE</a></li>
		</div>
		
<?PHP

if ($_SESSION['email'] == null || $_SESSION['password'] == null)
	echo (" YOU DO NOT HAVE AUTHORIZATION TO THIS PAGE. LEAVE NOW ");

//database connection information
$servername = "localhost";
$username = "testuser";
$password = "mypassword";
$database = "student";

//connect to database
$con = new mysqli($servername, $username, $password, $database);

//selects the correct row by taking the user inputs from the login page and checking them against the database to grab the rest of the information
$sql = "SELECT * FROM tbluser WHERE email='{$_SESSION['email']}' AND password='{$_SESSION['password']}'";
$result = $con->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//print the user input variables set in the login file
			echo nl2br("ID: " . $row["id"].
				"\nEmail: " . $row["email"]. 
				"\nPassword: " . $row["password"]. 
				"\nFirst Name: " . $row["firstName"]. 
				"\nLast Name: " . $row["lastName"].
				"\nAddress: " . $row["address"].
				"\nPhone Number: " . $row["phone"].
				"\n Social Security Number: ". $row["ssn"]. "<br>");
		}
	}	
	else {
		echo "Something went wrong";
			}

//Get classes student is already registered for
$classQuery = "SELECT * FROM tblclass WHERE email='{$_SESSION['email']}'";
$classResult = $con->query($classQuery);

	if ($classResult->num_rows > 0) {
		echo "<h3>\nClasses you are currently registered for:</h3>";
		echo "<div style='test-align: center;'>";
		while($classRow = $classResult->fetch_assoc()) {
			//print the class names
			echo "<p>" . $classRow['class_name'] . "</p>";
			}
		echo "</div>";
	}
	else {
		echo "You are not currently registered for any classes. Please register below.";
			}

//Form handling for register and withdraw
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['registerClass'])) {
		$className = $_POST['className'];
	
		//SQL INSERT statement to register the class
		$registerClassQuery = "INSERT INTO tblclass (email, class_name) VALUES ('{$_SESSION['email']}', '$className')";
	
	//EXECUTE SQL INSERT
		if ($con->query($registerClassQuery) === true) {
			echo "\nYou have successfully 
			registered for: $className.";
	} 	
		else {
			echo "Error registering for the class. Please try again." . $con->error;
		}
	} 
	elseif (isset($_POST['withdrawClass'])) {
		$className = $_POST['className'];
	
		//Delete from sql
		$withdrawClassQuery = "DELETE FROM tblclass WHERE email='{$_SESSION['email']}' AND class_name='$className'";

		//Execute sql delete
		if ($con->query($withdrawClassQuery) === true) {
			if ($con->affected_rows > 0) {
				echo "You have successfully withdrawn from: $className.";
			}
			else {
				echo "Error witdrawing from the class or you were not already registered for this class. Please try again." . $con->error;
			}
		}
	}
}
	?>
	
	<form method="post">
		<br>
		<label for="className">Class Name:</label><br>
		<input type="text" id="className" name="className" required><br>
		<input type="submit" name="registerClass" value="Register for Class">
	</form>
	
	<form method="post">
		<br>
		<label for="classNameWithdraw">Class Name:</label><br>
		<input type="text" id="classNameWithdraw" name="className" required><br>
		<input type="submit" name="withdrawClass" value="Withdraw from Class">
	</form>
	
	</body>
	
</html> 