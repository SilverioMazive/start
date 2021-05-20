<?php  

	include "connection.php";

	if(isset($_GET['tlcliente']))
    {

    	$telefone = $_GET['tlcliente'];

    	$sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$telefone'";
		$resultno1 = mysqli_query($conn, $sqlno1);
		if (mysqli_num_rows($resultno1) > 0) 
		{
		    $rowno1 = mysqli_fetch_assoc($resultno1);
		    $uid = $rowno1['uid'];

	    	$sqlJ = "SELECT tbvendas.valor AS valorgasto, tbvendas.data AS datacompra, tbvendas.telefone AS telefonedopagamento, tbvendas.vendedornome AS nomevendedor
					FROM tbvendas
				where tbvendas.uid='$uid'";

			$resultJ = mysqli_query($conn, $sqlJ);
			if(mysqli_num_rows($resultJ)){
				foreach ($resultJ as $key => $fornecedorNome) {
					$json[] = $fornecedorNome;
				}
				print_r(json_encode($json));
				
			}
			else
			{
			    //SEM DADOS
				$arr = array('compralist' => 1, 'resposta' => 'Nenhuma informação encontrada!');
				echo json_encode($arr);
			}
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
		$arr = array('paybad' => 1, 'resposta' => 'Sem dados completos para processar a lista de recarregamentos');
		echo json_encode($arr);
	}

?>