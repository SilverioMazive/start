<?php

if($descricao != "indefinido")   
{                         
	header("location: index.php");
}
            

if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
	$descricao =$_POST['descricao'];
	
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