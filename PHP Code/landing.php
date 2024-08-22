<!--This will be the landing page. It should have links to 'Home'(landing page), 'Login', and 'Registration'-->

<!DOCTYPE html>
<html lang="en">
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<title>Student Portal</title>
	</head>
	
	<style>
	body {background-color: white;}
	.header {
		background-color: crimson; color: white; text-align: center;
	}
	ul {list-style-type: none; margin: 0; padding: 0; overflow: hidden; background-color: blue;}
	li {float: left;}
	li a {display: inline-block; padding: 20px 20px; color: white;}
	</style>
	
	<body>
		<div class="header">
			<h1>Welcome to the Student Portal Website</h1>
		</div>
		
		<ul>
			<li><a href="landing.php"><span class="glyphicon glyphicon-home"></span>HOME</a></li>
			<li style="float:right"><a href="login.php"><span class="glyphicon glyphicon-user"></span>LOGIN</a></li>
			<li style="float:right"><a href="registration.php"><span class="glyphicon glyphicon-pencil"></span>REGISTRATION</a></li>
		</ul>
	</body>
</html>