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
		$datar->modify('+'.$datavalidade.' days');
		$datar->setTimezone(new DateTimeZone('Africa/Maputo'));
		$dataprod = $datar->format('Y-m-d H:i:s');

		$categoriaid = $_GET['categoriaid'];
		$prodtipo = '1';


		//PEGAR A IMAGEM
		$imgtitulo = $_FILES['image']['name'];
		$imgTmp = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];
		
		$imgExt = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
		$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
		$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
		if(in_array($imgExt, $allowExt))
		{
			if($imgSize < 50000000)
			{
			  move_uploaded_file($imgTmp ,$upload_dir.$userPic);
			}
			else
			{
				$errorMsg = 'O tamanho da imagem é grande deve ser menos que 50MB (Megabytes)';
				$arr = array('ErroImg' => 1, 'resposta' => $errorMsg);
				echo json_encode($arr);
			}
		}
		else
		{
			$errorMsg = 'Por favor selecione uma imagem valida';
			$arr = array('ErroImg' => 1, 'resposta' => $errorMsg);
			echo json_encode($arr);
		}


		if(!isset($errorMsg))
		{
			//INSERIR as informacoes do produto
	    	$sqlInsert = "INSERT INTO tbprod(nome, preco, descricao, estado, quantificadorid, quantidade, datavalidade, categoriaid, prodtipo, data, image, uid)
			values('$nome', '$preco', '$descricao', '$estado', '$quantificadorid', '$quantidade', '$dataprod', '$categoriaid', '$prodtipo', '$datanow', '$userPic', '$uidvendedor')";
			$resultInsert = mysqli_query($conn, $sqlInsert);

		    if($resultInsert)
		    {
		    	//Inserido com sucesso
				$arr = array('sucess' => 1, 'resposta' => 'Produto adicionado com sucesso!');
				echo json_encode($arr);
			}
			else
			{
			    //SEM DADOS
				$arr = array('Falha' => 1, 'resposta' => 'Erro durante a execução!');
				echo json_encode($arr);
			}
		}
		else
		{
		    //SEM DADOS
			$arr = array('Falha' => 2, 'resposta' => 'Erro durante a execução!');
			echo json_encode($arr);
		}
	}
	else
	{
	    //SEM DADOS
		$arr = array('Falha' => 3, 'resposta' => 'Erro durante a execução!');
		echo json_encode($arr);
	}
	
?>