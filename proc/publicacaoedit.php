<?php

include "connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tbpublicacoes WHERE instid=".$_SESSION['instid']." AND pubid=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $titulo = $row['titulo'];
        $ficheiro= $row['ficheiro'];
        $condicoesdeingresso = $row['condicoesdeingresso'];
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
    $titulo =htmlentities(mysqli_real_escape_string($conn , $_POST['titulo']));
    $duracao =htmlentities(mysqli_real_escape_string($conn , $_POST['duracao']));
    $condicoesdeingresso =htmlentities(mysqli_real_escape_string($conn , $_POST['condicoesdeingresso']));
    $areacientifica =htmlentities(mysqli_real_escape_string($conn , $_POST['areacientifica']));
    $regimeid =$_POST['regimeid'];
    $provinciaid =$_POST['provinciaid'];
    $descricao = $_POST['descricao'];
    $saidasprofissionais =$_POST['saidasprofissionais'];
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');
    $pubid = $_SESSION['pubid'];
      
    $query = "UPDATE tbpublicacoes 
        SET
        instid = '$instid', 
        titulo ='$titulo',
        duracao = '$duracao',
        condicoesdeingresso = '$condicoesdeingresso',
        areacientifica = '$areacientifica',
        regimeid = '$regimeid',
        provinciaid = '$provinciaid',
        descricao = '$descricao',
        saidasprofissionais = '$saidasprofissionais', 
        estado = '$estado'
    WHERE pubid=".$pubid;
    $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Curso atualizado com sucesso!</b>";
        header("location: mestradoall.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>