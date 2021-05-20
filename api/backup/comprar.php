<?php  

	//Adicionar produto na carrinha

	include "connection.php";
	include "variaveis.php";

	if (isset($_GET['prodid'])) 
	{

		$prodid = $_GET['prodid'];
				

		$sqlInsert = "INSERT INTO tbcompras(prodid, telefone, estado, data)
			values('$prodid', '$telefone', '$estado', '$datanow')";
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