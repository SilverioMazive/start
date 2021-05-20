<?php

$leituraadmin = 'indefinido';
$instid = $_SESSION['instid'];

$sql = "SELECT count(smsid) AS naolidas FROM tbsms WHERE leituraadmin='$leituraadmin' AND instid=".$instid;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $smsnaolidas = $row['naolidas'];
}

$sql2 = "SELECT count(gostoid) AS notfnaolidas FROM tbgostos 
INNER JOIN tbpublicacoes ON tbpublicacoes.pubid=tbgostos.pubid
 WHERE tbpublicacoes.instid=".$instid;
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $notfnaolidas = $row2['notfnaolidas'];
}

// $sql2 = "SELECT count(gostoid) AS notfnaolidas FROM tbgostos INNER JOIN tbusuario ON tbusuario.id=tbgostos.usuarioid)
// INNER JOIN tbpublicacoes ON tbpublicacoes.pubid=tbgostos.pubid
//  WHERE leituraadmin='$leituraadmin' AND tbpublicacoes.instid=".$instid;

// $sql = "SELECT count(smsid) AS naolidas FROM tbsms WHERE leituraadmin='$leituraadmin' AND instid=".$instid;
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $smsnaolidas = $row['naolidas'];
// }else {
//     header("location: login.php");
// }

?>