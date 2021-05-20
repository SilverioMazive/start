<?php

$instid = $_SESSION['instid'];


if($descricao == "indefinido")
{                
	header("location: index.php");
}


$sql = "SELECT * from tbinstituicoes WHERE instid = '$instid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$descricao = $row['descricao'];
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

if(isset($_POST['submit'])) {
  
   
	$descricao =htmlentities(mysqli_real_escape_string($conn , $_POST['descricao']));
	
    $query = "UPDATE tbinstituicoes SET descricao = '$descricao' WHERE instid = '$instid' ";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Descrição confirmada com sucesso!</b>";
        header("location: index.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>