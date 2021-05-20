<?php  

	include "connection.php";
	include "variaveis.php";


	$sqlJ = "SELECT * from tbcategorias order by nomecat asc";
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
		$arr = array('catlist' => 1, 'resposta' => 'Nenhuma informação encontrada!');
		echo json_encode($arr);
	}
	
	
?>