<?php

	
	$telefonelevantamento = '258'.$telefonevendedor;    
	$valorLevant = $valor;          
	// $nome = 'HakelaBetLevantar';
	$dataSeca = new DateTime('now');
	$dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
	$datalev = $dataSeca->format('Y-m-d H:i:s');       

	//$url = 'https://paga.musicambicano.com/index2.php';
	// //$data = array('id' => $idPost);//Se forem varios parametros $data = array('id' => $idPost, 'id2' => $idPost2);
	// $data = array('phone_number' => $telefonelevantamento,'amount' => $valorLevant, 'nome' => $nome);
	$url = 'https://cs.musicambicano.com/dreamseeder/c2b.php';
	$idPost = '1';
	$data = array('id' => $idPost);
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


	// Se for sucesso significa que a venda ocorreu bem
	if($respostaDoMpesa == 'INS-0')
	{

		$sqlusersaldo = "UPDATE tbcompras set estado='pago', data='$datanow' 
			where uid=$uid'";
		$resultusersaldo = mysqli_query($conn, $sqlusersaldo);
		if ($resultusersaldo) 
		{
			$arr = array('vendasucess' => 1, 'resposta' => 'Venda efectuada com sucesso!');
			echo json_encode($arr);	
		}
		else
		{
			$arr = array('fail' => 1, 'resposta' => 'Erro grave, entre em contacto com a nossa linha de cliente!');
			echo json_encode($arr);	
		}

	}
	

?>
