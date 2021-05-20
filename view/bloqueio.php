<?php session_start(); ?>
<?php 
include "connection.php";
include "_mozamor_%.php";

$telefone = $_GET['telefone'];
$datar =  new DateTime('now');
$datar->modify('+7 days');
$databloq = $datar->format('Y-m-d H:i:s');	
$motivo = 'Jogador ilegal';

$query = "INSERT INTO tbbloqueados (telefonenovo, telefoneantigo, motivo, data) VALUES ('$telefone', '$telefone', '$motivo','$databloq') ";
$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
?>