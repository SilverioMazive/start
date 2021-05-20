<?php  

    include_once "removeacentos.php";

	$telefonepagamento = '258'.$telefone;    
	$valor = $_GET['valor'];

	$nomeintro = str_replace(' ', '', str_replace(' ', '', remove_accent($vendedornome)));

	//Se a String tiver mais de 25 caracteres vai cortar o testo para nao dar erro de processamento no MPesa
	if(strlen($nomeintro) > 25)
	{
		$nome = substr($nomeintro,0,strpos($nomeintro,' ',10));
	}
	else
	{
		$nome = $nomeintro;
	}
    
    $dataSeca = new DateTime('now');
    $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
    $dataDeCompra = $dataSeca->format('Y-m-d H:i:s');
    
	$url = 'https://paga.musicambicano.com/index2.php';	
	//$url = 'http://localhost:8090/hakelaapp/c2b.php';
	$idPost = '1';
	//$data = array('id' => $idPost);//Se forem varios parametros $data = array('id' => $idPost, 'id2' => $idPost2);
	$data = array('phone_number' => $telefonepagamento,'amount' => $valor, 'nome' => $nome);
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
	$respostaDoMpesa = $obj->{'output_ResponseCode'};

	
    if($respostaDoMpesa == 'INS-0')
    {
    	//PROCESSAMENTO DO SUCESSO DO PAGAMENTO DO CLIENTE               
		$sqlInsert = "INSERT INTO tbrecarregamento(uid, telefone, valor, data)
			values('".$uidcliente."', '".$telefone."', '".$valor."', '".$dataDeCompra."')";
		$resultInsert = mysqli_query($conn, $sqlInsert);

        if($resultInsert)
        {
			//ENVIAR O SALDO PARA O VENDEDOR
			if ($envio == 'verdadeiro') 
			{
				include "venda.php";
			}
			else if ($envio == 'falso') 
			{
				$sqlusersaldo = "UPDATE tbcompras set estado='pago', data='$datanow' 
				where uid=$uidcliente'";
				$resultusersaldo = mysqli_query($conn, $sqlusersaldo);
			}
		}
		else
		{
			//DEVOLVER O SALDO DO USUARIO na sua conta
			$sqlusersaldo = "Update tbusuarios set ganho=ganho+'".$valor."' 
				where uid='".$uidcliente;
			$resultusersaldo = mysqli_query($conn, $sqlusersaldo);
			if ($resultusersaldo) 
			{
		 		//RECARREGAMENTO com sucesso
				$arr = array('usersaldo' => 1, 'resposta' => 'O saldo foi recarregado directamente na sua conta');
				echo json_encode($arr);
		 	} 	
		 	else
		 	{
		 		//RECARREGAMENTO FALHOU
				$arr = array('recargfail' => 1, 'resposta' => 'Erro durante a execução!');
				echo json_encode($arr);
		 	}

		}
	}
	else
	{
		//RECARREGAMENTO FALHOU
		$arr = array('recargfail' => 1, 'resposta' => 'Erro durante a execução! Tente novamente');
		echo json_encode($arr);
	}
	
?>