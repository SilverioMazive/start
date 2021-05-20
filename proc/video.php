<?php

 // session_start();
 $instid = $_SESSION['instid'];
 $upload_dir = "videos/";

$sql = "SELECT * from tbinstituicoes WHERE instid = '$instid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$video = $upload_dir.$row['video'];
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

if(isset($_POST['submit'])) {
  
   
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
    
    

    $query = "UPDATE tbinstituicoes SET video = '$ficheiro',
    videoext = '$ficheiroExt'
     WHERE instid = '$instid' ";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Video definido com sucesso!</b>";
        header("location: index.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>