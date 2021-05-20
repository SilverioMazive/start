<?php

include "../../processadorbd.php";

$connection = new mysqli($host,$username,$password,$dbname);
if (!$connection) {
    die("Error in database connection". $connection->connect_error);
}
?>