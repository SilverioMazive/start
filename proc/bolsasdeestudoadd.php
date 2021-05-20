<?php

if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
    $nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
    $duracao =htmlentities(mysqli_real_escape_string($conn , $_POST['duracao']));
    $condicoesdeingresso =htmlentities(mysqli_real_escape_string($conn , $_POST['condicoesdeingresso']));
    $areacientifica =htmlentities(mysqli_real_escape_string($conn , $_POST['areacientifica']));
    $localdaformacao =$_POST['localdaformacao'];    
    $descricao = $_POST['descricao'];
    $saidasprofissionais =$_POST['saidasprofissionais'];
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');
      
    $query = "INSERT INTO tbbolsasdeestudo
        (instid, nome, duracao, condicoesdeingresso, areacientifica, localdaformacao, descricao, saidasprofissionais, estado, data)
     VALUES 
     ('$instid', '$nome', '$duracao', '$condicoesdeingresso', '$areacientifica', '$localdaformacao', '$descricao', '$saidasprofissionais', '$estado', '$data')";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Bolsa de estudo adicionada com sucesso!</b>";
        header("location: bolsasdeestudoall.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>