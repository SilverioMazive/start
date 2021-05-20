<?php  

	include "connection.php";

    include "model/dbLogin.php";
    include "model/User.php";
    include "model/connection.php";

	$dataSeca = new DateTime('now');
	$dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
	$datalev = $dataSeca->format('Y-m-d H:i:s');

	if (isset($_GET['info'])) 
	{

		$info = $_GET['info'];

		$sqlvenda = "INSERT INTO vamos(info, data)
		  values('".$info."', '".$datalev."')";
		$resultvenda = mysqli_query($conn, $sqlvenda);

		if($resultvenda)
        {
			$arr = array('sucesso' => 1, 'resposta' => 'Inserimos a informacao com sucesso!');
	        echo json_encode($arr);
    	}
    	else
    	{
    		$arr = array('negou' => 1, 'resposta' => 'Insercao fracassada!');
	        echo json_encode($arr);
    	}
	}
	else
	{
		$arr = array('falha' => 1, 'resposta' => 'Algum erro aconteceu!');
        echo json_encode($arr);
	}

?>