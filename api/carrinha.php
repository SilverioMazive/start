<?php  

	//Adicionar produto na carrinha

	include "connection.php";
	include "variaveis.php";

	if (isset($_GET['prodid'])) 
	{

		$prodid = $_GET['prodid'];
		$estado = 'em processo';
		$recibo = 'em processo';

		$sqlInsert = "INSERT INTO tbcompras(prodid, telefone, estado, recibo, uid, data)
			values('$prodid', '$tlcliente', '$estado', '$recibo', '$uid', '$datanow')";
		$resultInsert = mysqli_query($conn, $sqlInsert);

	    if($resultInsert)
	    {
	    	//RECARREGAMENTO com sucesso
			$arr = array('sucess' => 1, 'resposta' => 'Produto adicionado na carrinha!');
			echo json_encode($arr);
		}
		else
		{
		    //SEM DADOS
			$arr = array('Falha' => 0, 'resposta' => 'Erro durante a execução!');
			echo json_encode($arr);
		}
	}
	
?>