<?php
// $connect = mysqli_connect("localhost", "root", "", "quizapp");
include "controller/permissao.php";

//Pegando o novo id
$sql2 = "SELECT * FROM questions order by question_number DESC limit 1";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);
$question_number = $row2['question_number'] + 1;

if ($_POST) {

	$pergunta = $_POST['pergunta']; 
	$correct = $_POST['correct']; 
	$catid = $_POST['catid']; 
	$descricao = $_POST['descricao']."."; 
	$estado = 'disponivel';

	$number = count($_POST["name"]);
	//if($number > 1)
	if($number > 0)
	{
		for($i=0; $i<$number; $i++)
		{
			if(trim($_POST["name"][$i] != ''))
			{
				
				if (($i + 1) == $_POST['correct']) 
				{
					$correct = '1';
				}
				else
				{
					$correct = '0';
				}

				//Aqui inserir a pergunta uma vez
				$sql3 = "INSERT into questions (pergunta, catid, descricao, data, estado)
	           	SELECT '".$pergunta."', '".$catid."', '".$descricao."', '".$datanow."', '".$estado."'	WHERE NOT EXISTS (SELECT  * from questions where question_number='".$question_number."')";
	           	
		      	$result3 = mysqli_query($conn, $sql3);

		      	//Aqui inserir as escolhas diversas vezes!
		      	$sql1 = "INSERT INTO choices(name,question_number) VALUES('".mysqli_real_escape_string($conn, $_POST["name"][$i])."','".$question_number."')";
		      	$result1 = mysqli_query($conn, $sql1);
		      	if($result1)
		      	{
		        	$_SESSION['info'] = 'Pergunta adicionada com sucesso!';
		        	header('Location: index.php');
		      	}
		      	// else{
		       //  	$errorMsg = 'Error '.mysqli_error($conn);
		      	// }

			}
		}
		
	}
}


?>