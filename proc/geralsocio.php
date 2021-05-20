<?php

if(isset($_SESSION['instid']))
{
    $instid = $_SESSION['instid'];
    // $data = date('Y-m-d');

    $resultdata2 =  new DateTime('now');
    $datag = $resultdata2->format('Y-m-d');

    $sql = "SELECT count(viewid) as viewshoje FROM tbview WHERE tbview.instid='$instid' AND tbview.data LIKE '$datag%'";
    // $sql = "SELECT count(viewid) as viewshoje FROM tbview WHERE tbview.instid='$instid' AND tbview.data LIKE '%2020-07-12%'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $viewshoje = $row['viewshoje'];
    }

    $sql2 = "SELECT count(viewid) as allviews FROM tbview WHERE tbview.instid='$instid'";
    $result2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($result2) > 0) {
        $row2 = mysqli_fetch_assoc($result2);
        $allviews = $row2['allviews'];
    }

    $sql3 = "SELECT count(pubid) as publicacoes FROM tbpublicacoes WHERE tbpublicacoes.instid='$instid'";
    $result3 = mysqli_query($conn, $sql3);
    if (mysqli_num_rows($result3) > 0) {
        $row3 = mysqli_fetch_assoc($result3);
        $publicacoes = $row3['publicacoes'];
    }

    $sql4 = "SELECT count(comid) as comentarios FROM tbcomentarios INNER JOIN tbpublicacoes ON tbpublicacoes.pubid=tbcomentarios.pubid WHERE tbpublicacoes.instid='$instid'";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        $row4 = mysqli_fetch_assoc($result4);
        $comentarios = $row4['comentarios'];
    }

    
}

?>