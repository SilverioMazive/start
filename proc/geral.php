<?php

if(isset($_SESSION['admingo']))
{
    $sql = "SELECT count(instid) as instituicoes FROM tbinstituicoes";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $instituicoes = $row['instituicoes'];
    }

    $sql2 = "SELECT count(id) as usuarios FROM tbusuario";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $usuarios = $row2['usuarios'];
    }

    $sql3 = "SELECT count(pubid) as publicacoes FROM tbpublicacoes";
    $result3 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result3) > 0) {
        $row3 = mysqli_fetch_assoc($result3);
        $publicacoes = $row3['publicacoes'];
    }

    $sql4 = "SELECT count(comid) as comentarios FROM tbcomentarios";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        $row4 = mysqli_fetch_assoc($result4);
        $comentarios = $row4['comentarios'];
    }

    
}

?>