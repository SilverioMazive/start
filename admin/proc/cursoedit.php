<?php

include "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbcursos WHERE instid=".$_SESSION['instid']." AND cursoid=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nome = $row['nome'];
        $duracao= $row['duracao'];
        $provasdeingresso = $row['provasdeingresso'];
        $areacientifica = $row['areacientifica'];
        $regimeid = $row['regimeid'];
        $provinciaid = $row['provinciaid'];
        $descricao = $row['descricao'];
        $saidasprofissionais = $row['saidasprofissionais'];

    }else {
        header("location: index.php");
    }
}



if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
    $nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
    $duracao =htmlentities(mysqli_real_escape_string($conn , $_POST['duracao']));
    $provasdeingresso =htmlentities(mysqli_real_escape_string($conn , $_POST['provasdeingresso']));
    $areacientifica =htmlentities(mysqli_real_escape_string($conn , $_POST['areacientifica']));
    $regimeid =$_POST['regimeid'];
    $provinciaid =$_POST['provinciaid'];
    $descricao = $_POST['descricao'];
    $saidasprofissionais =$_POST['saidasprofissionais'];
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');
    $cursoid = $_SESSION['cursoid'];
    unset($_SESSION['cursoid']);
      
    $query = "UPDATE tbcursos 
        SET
        instid = '$instid', 
        nome ='$nome',
        duracao = '$duracao',
        provasdeingresso = '$provasdeingresso',
        areacientifica = '$areacientifica',
        regimeid = '$regimeid',
        provinciaid = '$provinciaid',
        descricao = '$descricao',
        saidasprofissionais = '$saidasprofissionais', 
        estado = '$estado'
    WHERE cursoid=".$cursoid;
    $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Curso atualizado com sucesso!</b>";
        header("location: cursoall.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>