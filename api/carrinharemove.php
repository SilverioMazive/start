<?php  

	include "connection.php";
	include "variaveis.php";
	
	if (isset($_GET['prodid']) && isset($_GET['codigo']))) 
	{
		$prodid = $_GET['prodid'];
		$codigo = $_GET['codigo'];
		$estado = 'removido';

		$sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$tlcliente'";
		$resultno1 = mysqli_query($conn, $sqlno1);
		if (mysqli_num_rows($resultno1) > 0 && $codigo == "Dr&@mSeed3r") 
		{

			$sqlInsert = "UPDATE tbcompras SET estado = 'removido' WHERE prodid='$prodid'";
			$resultInsert = mysqli_query($conn, $sqlInsert);

		    if($resultInsert)
		    {
		    	//RECARREGAMENTO com sucesso
				$arr = array('sucess' => 1, 'resposta' => 'Produto removido com sucesso!');
				echo json_encode($arr);
			}
			else
			{
			    //SEM DADOS
				$arr = array('Falha' => 0, 'resposta' => 'Erro durante a execução!');
				echo json_encode($arr);
			}
		}
		else
		{
			//SEM DADOS
			$arr = array('Falha' => 0, 'resposta' => 'Acesso não permitido');
			echo json_encode($arr);
		}
		
	}
	
?>