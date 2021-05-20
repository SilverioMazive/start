<?php
session_start();
include "connection.php";
include "_mozamor_%.php";
if(isset($_POST['submit']))
{
	if (isset($_POST['password']))  {
		$password = $_POST['password'];
		$adminpass = 'playsilver0815';
		if ($password == $adminpass) 
		{
			$_SESSION['admin'] = "active";
			header("Location: adminhome.php");
		}
		else 
		{
			echo  "<script> alert('wrong password');</script>";
		}
	}
	// $_SESSION['admin'] = 'active';
	// header("location: adminhome.php");
}

//include "logincontrol.php";

?>



<html>
	<head>
		<title>PHP-kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<header>
			<div class="container">
				<h1>PHP-kuiz</h1>
				<a href="index.php" class="start">Home</a>

			</div>
		</header>

		<main>
		<div class="container">
				<h2>Enter Password</h2>
				<form method="POST" action="">
				<input type="password" name="password" required="" >
				<input type="submit" name="submit" value="send"> 

			</div>


		</main>

		<footer>
			<div class="container">
				Copyright @ PHP-kuiz
			</div>
		</footer>

	</body>
</html>