<?php


include "connection.php";

// var_dump($_COOKIE['mozamorvirus']);
//var_dump($_COOKIE['telefonecliente']);

$dias = '2';
$resultdata =  new DateTime('now');
$dataModificada = $resultdata->modify('+'.$dias.' hour');
$datatermino = $dataModificada->format('Y-m-d H:i:s');




$sql = "select * from tbbolasdasortex order by bsid desc limit 1";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	  $row = mysqli_fetch_assoc($result);
	  $dataterminobd = $row['datatermino'];
	  $datainicialbd = $row['datainicial'];
	  $bsid = $row['bsid'];

	  }

  $brai = new DateTime($datainicialbd);
  $brai2 = $brai->modify('+'.$dias.' hour');
  $datainicialadd = $brai2->format('Y-m-d H:i:s');

var_dump($datainicialadd);
echo "<br><br>";
var_dump($datainicialbd);
echo "<br><br>";
// var_dump($datainicialbd);
// echo "<br><br>";

// $vencedores = 'vencedor';
// $sqlvencedor = "SELECT count(vencedorid) as vencedor from tbvencedores where estado='vencedor'";
// $resultvencedor = mysqli_query($conn, $sqlvencedor);
// if (mysqli_num_rows($resultvencedor) > 0) {
//     $rowvencedor = mysqli_fetch_assoc($resultvencedor);
// }else {
//     $errorMsg = 'Nenhum dado disponivel';
// }

// var_dump($rowvencedor);


//RANDOM RESULT
    // $sql3 = "select * from tbbolascores order by rand() limit 1";
	//   $result3 = mysqli_query($conn, $sql3);
	//   if (mysqli_num_rows($result3) > 0) {
	// 	$row3 = mysqli_fetch_assoc($result3);
	// 	$bolageralcor = $row3['nome'];
    //     var_dump($bolageralcor);

	// 	}

// $sql = "select * from tbbolasdasortex order by bsid desc limit 1";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//     $row = mysqli_fetch_assoc($result);
//     $bsid = $row['bsid'];
//     var_dump($bsid - 1);

//     $bsidanterior = $bsid - 1;

//     $sql2 = "select * from tbbolasdasortex where bsid =".$bsidanterior;
//     $result2 = mysqli_query($conn, $sql2);
//     if (mysqli_num_rows($result2) > 0) {
//         $row2 = mysqli_fetch_assoc($result2);

//         echo "<br><br>";
//         $bolaverde = $row2['bolaverde'];
//         var_dump('Bola verde '.$bolaverde);
//         echo "<br><br>";
//         $bolaazul = $row2['bolaazul'];
//         var_dump('Bola azul '.$bolaazul);

//     }

// }

//AQUI GARANTE QUE O SERA UMA LETRA SOMENTE
// $ch = 'b';
// if (ctype_alpha($ch) && strlen($ch) == 1) {
//     print('Sim');
// } else {
//     print('nada');
// }


//AQUI GARANTE QUE O SERA TEXTO
// $ch = 'a';
//     if (ctype_alpha($ch)) {
//         print('Sim');
//     } else {
//         print('Nao');
//     }



?>