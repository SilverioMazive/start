<?php  

include "model/connection.php";

$resultdata2 =  new DateTime('now');
$resultdata2->setTimezone(new DateTimeZone('Africa/Maputo'));
$datag = $resultdata2->format('Y-m-d');


//Imprimindo Impostos Valor
if ($tipo == "supadmin" || $tipo == "admin") 
{
    //VALOR DOS IMPOSTOR PARA OS ADMINs
    $sql4 = "SELECT sum(preco) as impostos FROM tbimpostospay inner join tbimpostos on tbimpostos.impostoid=tbimpostospay.impostoid";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        $row4 = mysqli_fetch_assoc($result4);
        $impostos = $row4['impostos'];
    }

    //Numero de reclamacoes para os ADMINs
    $sql5 = "SELECT count(smsid) as reclamacoes FROM tbsms where tipo = 'reclamacoes' and parauser='admin';";
    $result5 = mysqli_query($conn, $sql5);
    if (mysqli_num_rows($result5) > 0) 
    {
        $row5 = mysqli_fetch_assoc($result5);
        $reclamacoes = $row5['reclamacoes'];
    }

    //Numero de compras para os ADMINs
    $sql6 = "SELECT count(compraid) as compras FROM tbcompras;";
    $result6 = mysqli_query($conn, $sql6);
    if (mysqli_num_rows($result6) > 0) 
    {
        $row6 = mysqli_fetch_assoc($result6);
        $compras = $row6['compras'];
    }

    $sql7 = "SELECT count(uid) as clientes FROM tbusuarios where tipo='cliente';";
    $result7 = mysqli_query($conn, $sql7);
    if (mysqli_num_rows($result7) > 0) 
    {
        $row7 = mysqli_fetch_assoc($result7);
        $clientes = $row7['clientes'];
    }

    $sql7 = "SELECT count(uid) as vendedor FROM tbusuarios where tipo='vendedor';";
    $result7 = mysqli_query($conn, $sql7);
    if (mysqli_num_rows($result7) > 0) 
    {
        $row7 = mysqli_fetch_assoc($result7);
        $vendedor = $row7['vendedor'];
    }

    $sql7 = "SELECT count(uid) as distribuidor FROM tbusuarios where tipo='distribuidor';";
    $result7 = mysqli_query($conn, $sql7);
    if (mysqli_num_rows($result7) > 0) 
    {
        $row7 = mysqli_fetch_assoc($result7);
        $distribuidor = $row7['distribuidor'];
    }

    $sql7 = "SELECT count(uid) as entregador FROM tbusuarios where tipo='entregador';";
    $result7 = mysqli_query($conn, $sql7);
    if (mysqli_num_rows($result7) > 0) 
    {
        $row7 = mysqli_fetch_assoc($result7);
        $entregador = $row7['entregador'];
    }

    $sql7 = "SELECT count(uid) as admin FROM tbusuarios where tipo='admin';";
    $result7 = mysqli_query($conn, $sql7);
    if (mysqli_num_rows($result7) > 0) 
    {
        $row7 = mysqli_fetch_assoc($result7);
        $admin = $row7['admin'];
    }
}
else
{
    //VALOR DOS IMPOSTOR PARA OS Usuarios
    $sql4 = "SELECT sum(preco) as impostos FROM tbimpostospay inner join tbimpostos on tbimpostos.impostoid=tbimpostospay.impostoid where tbimpostospay.uid='$userid'";
    $result4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($result4) > 0) {
        $row4 = mysqli_fetch_assoc($result4);
        $impostos = $row4['impostos'];
    }

    //Numero de reclamacoes para os Usuarios
    $sql5 = "SELECT count(smsid) as reclamacoes FROM tbsms where tipo = 'reclamacoes' and parauser='$userid';";
    $result5 = mysqli_query($conn, $sql5);
    if (mysqli_num_rows($result5) > 0) 
    {
        $row5 = mysqli_fetch_assoc($result5);
        $reclamacoes = $row5['reclamacoes'];
    }

    //Numero de compras para os ADMINs
    $sql6 = "SELECT count(compraid) as compras FROM tbcompras where uid='$userid';";
    $result6 = mysqli_query($conn, $sql6);
    if (mysqli_num_rows($result6) > 0) 
    {
        $row6 = mysqli_fetch_assoc($result6);
        $compras = $row6['compras'];
    }
}










$sqlno = "SELECT count(imagensid) as nivel0 FROM tbjogoimagens WHERE level = '0'";
$resultno = mysqli_query($conn, $sqlno);
if (mysqli_num_rows($resultno) > 0) 
{
    $rowno = mysqli_fetch_assoc($resultno);
    $nivel0 = $rowno['nivel0'];
}

$sqln1 = "SELECT count(imagensid) as nivel1 FROM tbjogoimagens WHERE level = '1'";
$resultn1 = mysqli_query($conn, $sqln1);
if (mysqli_num_rows($resultn1) > 0) 
{
    $rown1 = mysqli_fetch_assoc($resultn1);
    $nivel1 = $rown1['nivel1'];
}

$sqln2 = "SELECT count(imagensid) as nivel2 FROM tbjogoimagens WHERE level = '2'";
$resultn2 = mysqli_query($conn, $sqln2);
if (mysqli_num_rows($resultn2) > 0) 
{
    $rown2 = mysqli_fetch_assoc($resultn2);
    $nivel2 = $rown2['nivel2'];
}




$sql = "SELECT count(presultid) as viewshoje FROM tbpalavrasresult WHERE tbpalavrasresult.data LIKE '$datag%'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) 
{
    $row = mysqli_fetch_assoc($result);
    $viewshoje = $row['viewshoje'];
}

$sqlp = "SELECT count(imagensid) as perguntas FROM tbjogoimagens WHERE imagensid > '10'";
$resultp = mysqli_query($conn, $sqlp);
if (mysqli_num_rows($resultp) > 0) 
{
    $rowp = mysqli_fetch_assoc($resultp);
    $perguntas = $rowp['perguntas'];
}

$sql2 = "SELECT count(presultid) as allviews FROM tbpalavrasresult";
$result2 = mysqli_query($conn, $sql2);
if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $allviews = $row2['allviews'];
}


$sql3 = "SELECT count(palavraid) as palavras FROM tbpalavras";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    $row3 = mysqli_fetch_assoc($result3);
    $palavras = $row3['palavras'];
}

//AQUI FAZER O CALCULO TOTAL
$sql3 = "SELECT count(palavraid) as palavras FROM tbpalavras";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
    $row3 = mysqli_fetch_assoc($result3);
    $palavras = $row3['palavras'];
}





$sql4 = "SELECT sum(valor) as perdedor FROM tbpalavrasresult where resultado='perdedor'";
$result4 = mysqli_query($conn, $sql4);
if (mysqli_num_rows($result4) > 0) {
    $row4 = mysqli_fetch_assoc($result4);
    $ganhosjogos = $row4['perdedor'];
}


$sql5 = "SELECT sum(valor) as vencedor FROM tbpalavrasresult where resultado='vencedor'";
$result5 = mysqli_query($conn, $sql5);
if (mysqli_num_rows($result5) > 0) {
    $row5 = mysqli_fetch_assoc($result5);
    $perdasjogos = $row5['vencedor'];
}


// $sql4 = "SELECT count(comid) as comentarios FROM tbcomentarios INNER JOIN tbpalavras ON tbpalavras.pubid=tbcomentarios.pubid WHERE tbpalavras.instid='$instid'";
// $result4 = mysqli_query($conn, $sql4);
// if (mysqli_num_rows($result4) > 0) {
//     $row4 = mysqli_fetch_assoc($result4);
//     $comentarios = $row4['comentarios'];
// }


?>