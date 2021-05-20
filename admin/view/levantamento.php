<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
include "adminhomeprocess.php";
if (isset($_SESSION['admin'])) {

if(isset($_POST['submit'])) {
	$telefone ='258855400000';
    $valor = htmlentities(mysqli_real_escape_string($conn , $_POST['valor']));
    $usuarioid = "0";
    $meid = '1';
	$dataSeca = new DateTime('now');
	$data = $dataSeca->format('Y-m-d H:i');  


    //ADICIONAR ESTE TESTO AGORA ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    if (preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $valor) || preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $telefone) ) {
            
    }
    else {
        header("location: index.php");
    }

    $ValorDisponivel = $rowme['ganho'] - $rowme['perdas'];
    if($valor <= $ValorDisponivel)
    {

        $url = 'https://bet.musicambicano.com/virmaz/b2c.php';
        //$data = array('id' => $idPost);//Se forem varios parametros $data = array('id' => $idPost, 'id2' => $idPost2);
        $data = array('phone_number' => $telefone,'amount' => $valor, 'nome' => $nome, 'valordisponivel' => $ValorDisponivel);
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
       
        $context = stream_context_create($options);
        $resposta = file_get_contents($url, false, $context);
        if($resposta === FALSE) {echo ('Errado!');}
            
        //AQUI FILTRAR COM IF PARA DEPOIS PROCESSAR O PAGAMENTO    
        $obj = json_decode($resposta);
        $respostaDoMpesa = $obj->{'output_ResponseCode'}; // Resposta que eu preciso para continuar

        if($respostaDoMpesa == 'INS-0')
        {
        
            $sqlInsert = "INSERT INTO tblevantamento(usuarioid, telefone, valor, data)
             VALUES ('$usuarioid', '$telefone', '$valor', '$data') " ;
                $resultInsert = mysqli_query($conn, $sqlInsert);
            
            $sqlNosso = "Update tbme set ganho=ganho-'".$valor."' 
            where meid=".$meid;
            $resultNosso = mysqli_query($conn, $sqlNosso);        

            $_SESSION['info'] = 'Levantamento efectuado com sucesso, o valor sera enviado para a conta do MPesa do contacto '.$telefone;
            header("location: adminhome.php");                  

        }
        else
        {
            $error = $respostaDoMpesa;
        }
    }
    else
    {
        $error = 'Não tens saldo suficiente para efectuar o levantamento';
    }


	// $query = "INSERT INTO tblevantamento(usuarioid, telefone, valor, data) VALUES ('$usuarioid', '$telefone', '$valor', '$data') " ;
	// $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	// if (mysqli_affected_rows($conn) > 0 ) {
    //     // echo "<script>alert('Question successfully added'); </script> " ;
    //     header("location: index.php");
	// }
	// else {
	// 	"<script>alert('error, try again!');</script>";
	// }
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<?php
			include "header.php";
		?>

		<main>
			<div class="container">
				<h2>Levantar</h2>
				<form method="post" action="levantamento.php">

					<p>
						<label>Valor</label>
						<input type="number" name="valor" required="">
					</p>
					<p>
						<label>Telefone</label>
						<input type="number" name="telefone" required="">
					</p>
					<p>
						<input type="submit" name="submit" value="Submit">
					</p>
				</form>
			</div>
		</main>

		

	</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>