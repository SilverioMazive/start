<?php

include "connection.php";
include "_mozamor_%.php";

$meid = '1';
$sql = "SELECT * from tbme where meid=".$meid;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $rowme = mysqli_fetch_assoc($result);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

$sqlvencedor = "SELECT count(vencedorid) as vencedor from tbvencedores where estado='vencedor'";
$resultvencedor = mysqli_query($conn, $sqlvencedor);
if (mysqli_num_rows($resultvencedor) > 0) {
    $rowvencedor = mysqli_fetch_assoc($resultvencedor);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}


$sqlpalavras = "SELECT * from tbsocios where socioid='2'";
$resultpalavras = mysqli_query($conn, $sqlpalavras);
if (mysqli_num_rows($resultpalavras) > 0) {
    $rowpalavras = mysqli_fetch_assoc($resultpalavras);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}


$sqlperdedor = "SELECT count(vencedorid) as perdedor from tbvencedores where estado='perdedor'";
$resultperdedor = mysqli_query($conn, $sqlperdedor);
if (mysqli_num_rows($resultperdedor) > 0) {
    $rowperdedor = mysqli_fetch_assoc($resultperdedor);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

$sqlusuarios = "SELECT count(id) as usuarios from tbusuario";
$resultusuarios = mysqli_query($conn, $sqlusuarios);
if (mysqli_num_rows($resultusuarios) > 0) {
    $rowusuarios = mysqli_fetch_assoc($resultusuarios);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

$sqllevantamentos = "SELECT count(levantamentoid) as levantamentos from tblevantamento";
$resultlevantamentos = mysqli_query($conn, $sqllevantamentos);
if (mysqli_num_rows($resultlevantamentos) > 0) {
    $rowlevantamentos = mysqli_fetch_assoc($resultlevantamentos);
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

?>