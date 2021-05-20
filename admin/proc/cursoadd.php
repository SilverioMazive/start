<?php

if(isset($_POST['submit'])) {

    $upload_dir = 'uploads/';
  
    $instid = $_SESSION['instid'];
    $nome = htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
    $duracao = htmlentities(mysqli_real_escape_string($conn , $_POST['duracao']));
    $provasdeingresso = htmlentities(mysqli_real_escape_string($conn , $_POST['provasdeingresso']));
    $areacientifica = htmlentities(mysqli_real_escape_string($conn , $_POST['areacientifica']));
    $regimeid = (int)str_replace(' ', '', intval($_POST['regimeid']));
    $provinciaid =(int)str_replace(' ', '', intval($_POST['provinciaid']));
    $nivel =(int)str_replace(' ', '', intval($_POST['nivel']));
    $descricao = mysqli_real_escape_string($conn,$_POST['descricao']);
    $saidasprofissionais = mysqli_real_escape_string($conn,$_POST['saidasprofissionais']);
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');

    //IMAGEM 1
    $imagem1 = $_FILES['img1']['name'];
    $imgTmp = $_FILES['img1']['tmp_name'];
    $imgSize = $_FILES['img1']['size'];
    $imgExt = strtolower(pathinfo($imagem1, PATHINFO_EXTENSION));
    $allowExt  = array('jpeg', 'jpg', 'png', 'gif');
    $img = time().'_'.rand(1000,9999).'.'.$imgExt;
    if(in_array($imgExt, $allowExt)){
        if($imgSize < 50000000){
            move_uploaded_file($imgTmp ,$upload_dir.$img);
        }else{
            $errorMsg = 'O tamanho da imagem1 é grande deve ser menos que 50MB (Megabytes)';
        }
    }else{
        $errorMsg = 'Por favor selecione uma imagem valida';
    }
      
    $query = "INSERT INTO tbcursos
        (instid, nome, duracao, provasdeingresso, areacientifica, regimeid, provinciaid, descricao, saidasprofissionais, estado, img, nivel, data)
     VALUES 
     ('$instid', '$nome', '$duracao', '$provasdeingresso', '$areacientifica', '$regimeid', '$provinciaid', '$descricao', '$saidasprofissionais', '$estado', '$img','$nivel','$data')";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Curso adicionado com sucesso!</b>";
        header("location: index.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>