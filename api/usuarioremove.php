<?php  

	include "connection.php";

	$telefone = $_GET['tlcliente'];

	$sql = "DELETE FROM tbusuarios WHERE telefone=".$telefone;
	if(mysqli_query($conn, $sql))
	{
	   //DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		$arr = array('noncliente' => 1, 'resposta' => 'Usuario removido!');
		echo json_encode($arr);
	} else{
		//DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
		$arr = array('errocliente' => 2, 'resposta' => 'Erro!');
		echo json_encode($arr);
		echo "<br>";
	    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}

	// $sqlno1 = "DELETE FROM tbusuarios where telefone=".$telefone;
	// $resultno1 = mysqli_query($conn, $sqlno1);
	// if (mysqli_num_rows($resultno1) > 0) 
	// {
	    
	//     while($rowno1 = mysqli_fetch_assoc($resultno1))
	//     {
	//         //DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
	// 		$arr = array('noncliente' => 1, 'resposta' => 'Usuario removido!');
	// 		echo json_encode($arr);
	//     }
		
	// }
	// else
	// {
	// 	//DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
	// 	$arr = array('noncliente' => 1, 'resposta' => 'Erro!');
	// 	echo json_encode($arr);
	// }
    

?>