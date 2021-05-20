<?php  

	if(isset($_GET['tlcliente']))
    {
    	$telefone = $_GET['tlcliente'];
    	$telefonepagamento = '258'.$telefone;    
		$nome = "RecarregamentoHakela";
		$valor = $_GET['valor'];
			        
	    $dataSeca = new DateTime('now');
	    $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
	    $dataDeCompra = $dataSeca->format('Y-m-d H:i:s');
	        
		//$url = 'https://bet.musicambicano.com/virmaz/index2.php';	
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
	    	$sqlInsert = "INSERT INTO tbrecarregamento(uid, telefone, valor, data)
				values('".$uid."', '".$telefone."', '".$valor."', '".$dataDeCompra."')";
			$resultInsert = mysqli_query($conn, $sqlInsert);

			if ($resultInsert) 
			{

				//ENVIAR O SALDO PARA O VENDEDOR        	
				$sqlus = "UPDATE tbusuarios set ganho=ganho+'$valor' WHERE telefone=".$telefone;
				$resultus = mysqli_query($conn, $sqlus);

				//RECARREGAMENTO com sucesso
				$arr = array('recargsucess' => 1, 'resposta' => 'Recarregamento efectuado com sucesso!');
				echo json_encode($arr);

			}
			else
			{
				//RECARREGAMENTO FALHOU
				$arr = array('recargfail' => 1, 'resposta' => 'Erro durante a execução! Tente novamente');
				echo json_encode($arr);
			}
		}
		else
		{
			//RECARREGAMENTO FALHOU
			$arr = array('recargfail' => 1, 'resposta' => 'Erro durante a execução! Tente novamente');
			echo json_encode($arr);
		}
	}
	else
	{
		//DEVOLVER RESPOSTA DE QUE NAO TEM DADOS SUFICIENTES PARA PROCESSAR O PEDIDO
		//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
		$arr = array('paybad' => 1, 'resposta' => 'Sem dados completos para processar o recarregamentos');
		echo json_encode($arr);
	}

	

?>