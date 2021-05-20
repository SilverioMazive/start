<?php

    session_start();
    
    include "connection.php";
    
    if(isset($_COOKIE['socioid']))
    {
        $socioid = $_COOKIE['socioid'];
        $_SESSION['socioid'] = $socioid;
    }
    else if (isset($_SESSION['socioid'])) 
    {
        $socioid = $_SESSION['socioid'];
    }
    else if (isset($_SESSION['admingo'])) 
    {
        $admingo = $_SESSION['admingo'];
    }
    else
    {
        session_destroy();
        header("location: ../index.php");
    }

    if(isset($_SESSION['socioid']))
    {
        $sql = "SELECT * FROM tbinstituicoes INNER JOIN tbinstituicoestipo 
        ON tbinstituicoestipo.insttpid=tbinstituicoes.insttpid WHERE tbinstituicoes.socioid=".$socioid;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nome = $row['nome'];
            $insttpid = $row['insttpid'];
            $descricao = $row['descricao'];
            $acronimo = $row['acronimo'];
            
            $_SESSION['insttpid'] = $insttpid;
        }

    }
    
    
    // if(isset($_COOKIE['socioid']))
    // {
        
    // }
    // else
    // {
    //     header("location: ../index.php");
    // }

?>