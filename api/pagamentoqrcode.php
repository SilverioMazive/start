<?php  

	$telefone = $_GET['tlcliente'];    	
	$telefonevendedor = $_GET['tlvendedor'];
	$valor = $_GET['valor'];

	//LOCALIZAR O VENDEDOR SE ESTA CADASTRADO
	$sqlno = "SELECT * FROM tbusuarios WHERE telefone='$telefonevendedor'";
	$resultno = mysqli_query($conn, $sqlno);
	if (mysqli_num_rows($resultno) > 0) 
	{
	    $rowno = mysqli_fetch_assoc($resultno);
	    $vendedornome = $rowno['nome'];
	    $vendedorid = $rowno['uid'];

	    //VER SE TEM CLIENTE COM O CONTACTO
	    $sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$telefone'";
		$resultno1 = mysqli_query($conn, $sqlno1);
		if (mysqli_num_rows($resultno1) > 0) 
		{
		    $rowno1 = mysqli_fetch_assoc($resultno1);
		    $uid = $rowno1['uid'];
		    $ganho = $rowno1['ganho'];
	    	$nomecliente = $rowno1['nome'];

		    if($ganho >= $valor)
		    {
		    	//PAGAMENTO DIRETO PARA QUEM TEM SALDO NA CONTA
		    	$sqlusercompra = "UPDATE tbusuarios set ganho=ganho-$valor 
					where uid=$uid";
				$resultusercompra = mysqli_query($conn, $sqlusercompra); 	

				if($resultusercompra)
		        {
					//ENVIAR O SALDO PARA O VENDEDOR
		        	include "venda.php";
				}
				else
				{
					//FALHA DURANTE O PROCESSAMENTO
					$arr = array('falhadecobranca' => 1, 'resposta' => 'Falha uma durante a cobranca');
					echo json_encode($arr);
				}			    	
		    }
		    else
		    {
		    	//PROCESSAR O PAGAMENTO
		    	$envio = 'verdadeiro';
		    	include "pagamento.php";
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
		//DEVOLVER RESPOSTA DE QUE NAO TEM VENDEDOR COM ESSE NUMERO E PEDIR REGISTRO
		$arr = array('nonvendedor' => 1, 'resposta' => 'Não temos registo de um vendedor com este contacto');
		echo json_encode($arr);
	}

?>