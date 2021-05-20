<?php
session_start();
include "_mozamor_%.php";
if (isset($_COOKIE['gome'])) {
	header("location: adminhome.php");
}
else
{
	header("location: login.php");
}

?>