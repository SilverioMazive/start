<?php
//Esconde erros
ini_set('display_errors', 0 );
error_reporting(0);
?>
<?php

    session_start();

    include "model/connection.php";
    include "src.php";

    $tipo = "entregador";
    $userid = "3";
    $telefone ="855400000";
    $datar =  new DateTime('now');
    $datar->setTimezone(new DateTimeZone('Africa/Maputo'));//Deve ser a data do brasil
    $datanow = $datar->format('Y-m-d H:i:s');

    // if(isset($_COOKIE['socioid']))
    // {
        $socioid = $_COOKIE['socioid'];

        $sql = "SELECT * FROM tbusuarios 
        WHERE telefone='855400000'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome = $row['nome'];
            $telefone = $row['telefone'];
            $userid = $row['uid'];
            $ganho = round($row['ganho'], 2);
            $investimento = round($row['investimento'], 2);   
        }
    // }
    // else
    // {
    //     header("location: login.php");
    // }

?>