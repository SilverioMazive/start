<?php  

	include "connection.php";
	include "variaveis.php";

	if (isset($_GET['nome']) && isset($_GET['preco']) && isset($_GET['descricao']) && isset($_GET['quantificadorid']) && isset($_GET['quantidade']) && isset($_GET['datavalidade']) && isset($_GET['categoriaid'])) 
	{

		$nome = $_GET['nome'];
		$preco = $_GET['preco'];
		$descricao = $_GET['descricao'];
		$estado = 'valido';
		$quantificadorid = $_GET['quantificadorid'];
		$quantidade = $_GET['quantidade'];
		$datavalidade = $_GET['datavalidade'];
		$categoriaid = $_GET['categoriaid'];
		

		$sqlInsert = "INSERT INTO tbprod(nome, preco, descricao, estado, quantificadorid, quantidade, datavalidade, categoriaid, data)
			values('$nome', '$preco', '$descricao', '$estado', '$quantificadorid', '$quantidade', '$datavalidade', '$categoriaid', '$datanow')";
		$resultInsert = mysqli_query($conn, $sqlInsert);

	    if($resultInsert)
	    {
	    	//RECARREGAMENTO com sucesso
			$arr = array('sucess' => 1, 'resposta' => 'Produto adicionado com sucesso!');
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