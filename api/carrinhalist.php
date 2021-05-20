<?php  

	include "connection.php";

	if(isset($_GET))
    {
    	$estado = 'em processo';

    	$sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$tlcliente'";
		$resultno1 = mysqli_query($conn, $sqlno1);
		if (mysqli_num_rows($resultno1) > 0)
		{
		    $rowno1 = mysqli_fetch_assoc($resultno1);

	    	$sqlJ = "SELECT * FROM tbcompras WHERE telefone='$tlcliente' and estado='$estado' order by compraid asc";

			$resultJ = mysqli_query($conn, $sqlJ);
			if(mysqli_num_rows($resultJ)){
			    foreach ($resultJ as $key => $fornecedorNome) 
			    {
					$json[] = $fornecedorNome;
				}
				print_r(json_encode($json));
			}
			else
			{
			    //SEM DADOS
				$arr = array('carrinhalist' => 1, 'resposta' => 'Nenhuma informação encontrada!');
				echo json_encode($arr);
			}
		}
		else
		{
			//DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
			$arr = array('Error' => 1, 'resposta' => 'Erro durante a execução!');
			echo json_encode($arr);
		}
    }
    else
	{
		//DEVOLVER RESPOSTA DE QUE NAO TEM DADOS SUFICIENTES PARA PROCESSAR O PEDIDO
		$arr = array('Error' => 1, 'resposta' => 'Sem dados completos para processar a lista de encomendas');
		echo json_encode($arr);
	}

?>