<?php

	include "processadorbd.php";

    $conn = mysqli_connect($host, $username, $password, $dbname) or die("could not connect" . mysqli_error($conn) ) ;
?>
