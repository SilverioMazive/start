<?php

	$sqlusersaldo = "UPDATE tbcompras set estado='pago', data='$datanow' 
		where uid=$uid'";
	$resultusersaldo = mysqli_query($conn, $sqlusersaldo);
	if ($resultusersaldo)  
	{
		$arr = array('vendasucess' => 1, 'resposta' => 'Venda efectuada com sucesso!');
		echo json_encode($arr);	
	}
	else
	{
		$arr = array('fail' => 1, 'resposta' => 'Erro grave, entre em contacto com a nossa linha de cliente!');
		echo json_encode($arr);	
	}
	
?>
