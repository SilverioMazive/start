<?php

if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
	$nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
	
    $query = "UPDATE tbinstituicoes SET nome = '$nome' WHERE instid = '$instid' ";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Nome da instituição alterado com sucesso!</b>";
        header("location: index.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>