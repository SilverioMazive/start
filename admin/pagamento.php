<?php  

    include_once "removeacentos.php";

	$telefonepagamento = '258'.$_POST['telefone'];    

	$nomeintro = 'MunicipioCidadeMaputo';

	//Se a String tiver mais de 25 caracteres vai cortar o testo para nao dar erro de processamento no MPesa
	if(strlen($nomeintro) > 25)
	{
		$nome = substr($nomeintro,0,strpos($nomeintro,' ',10));
	}
	else
	{
		$nome = $nomeintro;
	}
    
	$url = 'https://paga.musicambicano.com/index2.php';
	$data = array('phone_number' => $telefonepagamento,'amount' => $valor, 'nome' => $nome);

	// $url = 'http://localhost:8090/dreamseeder/api/c2b.php';
	// $idPost = '1';
	$data = array('id' => $idPost);//Se forem varios parametros $data = array('id' => $idPost, 'id2' => $idPost2);
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
			values('".$userid."', '".$telefonepagamento."', '".$valor."', '".$datanow."')";
		$resultInsert = mysqli_query($conn, $sqlInsert);

        if($resultInsert)
        {
			setcookie('info', "<b style='color: blue;'>Imposto pago com sucesso, para levantar o recibo dirija-se ao centro de atendimento do mercado a que pertence.</b>", (time() + 5));
            header("location: index.php");
		}
		
	}
	else
	{
		//RECARREGAMENTO FALHOU
		$arr = array('recargfail' => 1, 'resposta' => 'Erro durante a execução! Tente novamente');
		echo json_encode($arr);
	}
	
?>