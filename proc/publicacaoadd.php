<?php

include "proc/connection.php";

$upload_dir = 'ficheiros/';

if(isset($_POST['submit'])) {
  
    $instid = $_SESSION['instid'];
    $titulo =htmlentities(mysqli_real_escape_string($conn , $_POST['titulo']));
    $descricao = $_POST['descricao'];
    $ficheiroescolha =htmlentities(mysqli_real_escape_string($conn , $_POST['ficheiroescolha']));       
    $estado = 'indefinido';
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');
      
    if($ficheiroescolha == 'imagem')
    {
      $imagem1 = $_FILES['ficheiro']['name'];
      $ficheiroTmp = $_FILES['ficheiro']['tmp_name'];
      $ficheiroSize = $_FILES['ficheiro']['size'];
      $ficheiroExt = strtolower(pathinfo($imagem1, PATHINFO_EXTENSION));
      $allowExt  = array('jpeg', 'jpg', 'png', 'gif');
      $ficheiro = time().'_'.rand(1000,9999).'.'.$ficheiroExt;
      if(in_array($ficheiroExt, $allowExt)){
          if($ficheiroSize < 50000000){
              move_uploaded_file($ficheiroTmp ,$upload_dir.$ficheiro);
          }else{
              $errorMsg = 'O tamanho da imagem1 é grande deve ser menos que 50MB (Megabytes)';
          }
      }else{
          $errorMsg = 'Por favor selecione uma imagem valida';
      }
    }
    else if($ficheiroescolha == 'video')
    {
      $ficheiro1 = $_FILES['ficheiro']['name'];
      $ficheiroTmp = $_FILES['ficheiro']['tmp_name'];
      $ficheiroSize = $_FILES['ficheiro']['size'];
      $ficheiroExt = strtolower(pathinfo($ficheiro1, PATHINFO_EXTENSION));
      $allowExt  = array('mp4', '3gp', 'webm', 'ogv');
      $ficheiro = time().'_'.rand(1000,9999).'.'.$ficheiroExt;
      if(in_array($ficheiroExt, $allowExt)){
          if($ficheiroSize < 50000000){
              move_uploaded_file($ficheiroTmp ,$upload_dir.$ficheiro);
          }else{
              $errorMsg = '<b style="color: red;">O tamanho do video é grande deve ser menos que 50MB (Megabytes)</b>';
          }
      }else{
          $errorMsg = '<b style="color: red;">Por favor selecione um video valido</b>';
      }
    }
    
    if(!isset($errorMsg)){

        $query = "INSERT INTO tbpublicacoes (instid, titulo, descricao, ficheiro, ficheiroescolha, ext, estado , data) VALUES 
        ('$instid' ,'$titulo' , '$descricao' , '$ficheiro' , '$ficheiroescolha' , '$ficheiroExt' , '$estado' , '$data') " ;
        $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            $_SESSION['info'] = "<b style='color: blue;'>Publicacao inserida com sucesso!</b>";
            header("location: publicacaoall.php");
        }
        else {
            "<script>alert('error, try again!'); </script>";
        }
       
    }

}

?>