<?php

	include "connection.php";

	if(isset($_GET['tlcliente']) && isset($_GET['valor']))
    {
    	$telefone = $_GET['tlcliente'];    	
		$valor = $_GET['valor'];

	    //VER SE TEM CLIENTE COM O CONTACTO
	    $sqlno1 = "SELECT * FROM tbusuarios WHERE telefone=".$telefone;
		$resultno1 = mysqli_query($conn, $sqlno1);
		if (mysqli_num_rows($resultno1) > 0) 
		{
		    $rowno1 = mysqli_fetch_assoc($resultno1);
		    $uid = $rowno1['uid'];
		    
		    include "recarregamentoprocess.php";

		}
		else
		{
			//DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
			$arr = array('noncliente' => 1, 'resposta' => 'Este cliente não tem numero registado na plataforma');
			echo json_encode($arr);
		}
    }
    else
	{
		//DEVOLVER RESPOSTA DE QUE NAO TEM DADOS SUFICIENTES PARA PROCESSAR O PEDIDO
		//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
		$arr = array('paybad' => 1, 'resposta' => 'Sem dados completos para processar o recarregamento');
		echo json_encode($arr);
	}

?>