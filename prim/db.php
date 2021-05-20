<?php
//Esconde erros
ini_set('display_errors', 0 );
error_reporting(0);
?>
<?php

include "../processadorbd.php";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

?>
