<!--This will be the Login page it should have fields to enter login and username and grab from the SQL to verify 
    information and should then hide the login and Registration links but produce a Login button and a Profile button'-->

<?PHP
//start the session to carry over user input
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Student Portal</title>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            var header = document.querySelector('.header h1');
            if (header) {
                header.textContent = "Welcome to the Login Page";
            }
        });
    </script>
	</head>

<body>
<?PHP include 'landing.php';

//database connection information
$servername = "localhost";
$username = "testuser";
$password = "mypassword";
$database = "student";

//connect to database
$con = new mysqli($servername, $username, $password, $database);

// Globally checks if the form was submitted and if it was a post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pull the data from the form
    $emailInput = $_POST['emailInput'];
    $passwordInput = $_POST['passwordInput'];
	//pull the user input into the session variable
	$_SESSION['email'] = "$emailInput";
	$_SESSION['password'] = "$passwordInput";
	
	//let user know if connection to server failed
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}
	
$sql = "SELECT email, password FROM tbluser WHERE email='$emailInput' AND password='$passwordInput'";
$result = $con->query($sql);

	if ($result->num_rows > 0) {
		echo ("Successful Login");
		header("Location: profile.php"); //redirect to profile page that only shows logout and profile page
	}	
	else {
		echo "The email or password you entered was incorrect. Please try again or register.";
			}
		}
		

?>


<h3>Please enter your email and password to login.</h3>

<form method="post"> <!--must be a form, have spot for email and password, need submit button-->
		<label for="email">Email:</label><br>
		<input type="text" id="email" name="emailInput"><br>
		<label for="password">Password:</label><br>
		<input type="text" id="password" name="passwordInput"><br>
		<input type="submit" value="Login" name="submit">
</form>

</body>

</html>