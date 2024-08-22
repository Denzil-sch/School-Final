<!--This will create the logout button, it should not appear until the user is logged in, 
    should connect to the database, and should redirect to the landing page after they logout-->
	
<?PHP
//start the session to carry over user input
session_start();
?>

<?PHP

session_unset();

session_destroy();

	?>
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
			<h1>You have been successfully logged out. Please return to the home page.</h1>
		</div>
		
		<div class="ul">
			<li><a href="landing.php"><span class="glyphicon glyphicon-log-out"></span>HOME</a></li>
		</div>
		
	</body>

</html>