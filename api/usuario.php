<?php  

	include "connection.php";

	$telefone = $_GET['tlcliente'];

	$sqlno1 = "SELECT tbusuarios.uid as id, tbusuarios.nome as nome, tbusuarios.telefone as telefone, tbusuarios.ganho as saldo, tbusuarios.data as data_de_registro FROM tbusuarios WHERE telefone=".$telefone;
	$resultno1 = mysqli_query($conn, $sqlno1);
	if (mysqli_num_rows($resultno1) > 0) 
	{
		foreach ($resultno1 as $key => $fornecedorNome) {
			$json[] = $fornecedorNome;
		}
		print_r(json_encode($json));
		
	    /*
	    while($rowno1 = mysqli_fetch_assoc($resultno1))
	    {
	        echo json_encode($rowno1);
	    }
		*/
	}
	else
	{
		//DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		$arr = array('noncliente' => 1, 'resposta' => 'Erro!');
		echo json_encode($arr);
	}
    

?>