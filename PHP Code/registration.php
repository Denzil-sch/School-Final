<!--This will be the Registration page it should have fields to enter all of the users data as
    required and store it in the SQL to save the information in tables'-->
	
<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Student Portal</title>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            var header = document.querySelector('.header h1');
            if (header) {
                header.textContent = "Welcome to the Registration Page";
            }
        });
    </script>
	</head>

<body>

<?PHP
include 'landing.php';

$servername = "localhost";
$username = "testuser";
$password = "mypassword";
$database = "student";

class sqlConnection{
	public $con;
	
	function get_con($newServername, $newUsername, $newPassword, $newDatabase) {
		$this->con = new mysqli($newServername, $newUsername, $newPassword, $newDatabase);
		
		if ($this->con->connect_error) {
			die("Connection failed: " . $this->con->connect_error);
		}
		echo "Connected successfully<br>";
	}
	
	function executeSelectQuery($sql) {
		$result = $this->con->query($sql);
		
		if ($result === false) {
			die("Error executing the query: " . $this->con->error);
		}
		
		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	function executeQuery($sql) {
		if ($this->con->query($sql) === true) {
			echo "You have been successfully registered!";
		}
		else {
			echo "Error executing the query: " . $this->con->error;
		}
	}
}
// Create an instance of the sqlConnection class
$testCon = new sqlConnection();

// Call the get_con() method on the instance to connect to the server and database
$testCon->get_con($servername, $username, $password, $database);

// Globally checks if the form was submitted and if it was a post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pull the data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $ssn = $_POST['ssn'];
    
    // SQL INSERT statement to be called in the next variable
    $insertQuery = "INSERT INTO tbluser (email, password, firstName, lastName, address, phone, ssn) VALUES ('$email', '$password', '$firstName', '$lastName', '$address', '$phone', '$ssn')";
    
    // Execute the SQL INSERT statement
    $testCon->executeQuery($insertQuery);
}

?>
	<!--creates the form and the method type so we can get input from the end user for submission-->
	<form method="post">
		<label for="email">Email:</label><br>
		<input type="text" id="email" name="email"><br>
		<label for="password">Password:</label><br>
		<input type="text" id="password" name="password"><br>
		<label for="firstName">First name:</label><br>
		<input type="text" id="firstName" name="firstName"><br>
		<label for="lastName">Last name:</label><br>
		<input type="text" id="lastName" name="lastName"><br>
		<label for="address">Address:</label><br>
		<input type="text" id="address" name="address"><br>
		<label for="phone">Phone number:</label><br>
		<input type="text" id="phone" name="phone"><br>
		<label for="ssn">Social Security Number:</label><br>
		<input type="text" id="ssn" name="ssn"><br>
		<input type="submit" value="Submit">
	</form>

</body>
</html>