<?php

	include "connection.php";

	if(isset($_GET['tlcliente']) && isset($_GET['tlvendedor']) && isset($_GET['valor']))
    {
    	//Pagamentos Qr Code
      	include "pagamentoqrcode.php";
	}
	else if (isset($_GET['tlcliente']) && isset($_GET['valor']))
	{
		//Para pagamentos no website
    	include "pagamentoweb.php";
	}
	else
	{
		//DEVOLVER RESPOSTA DE QUE NAO TEM DADOS SUFICIENTES PARA PROCESSAR O PEDIDO
		//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
		$arr = array('payoff' => 1, 'resposta' => 'Sem dados completos para processar o pagamento');
		echo json_encode($arr);
	}

?>
