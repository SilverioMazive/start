<?php

 // session_start();
 $instid = $_SESSION['instid'];
 $upload_dir = "uploads/";

$sql = "SELECT * from tbinstituicoes WHERE instid = '$instid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$imagem = $upload_dir.$row['imagem'];
}else {
    $errorMsg = 'Nenhum dado disponivel';
}

if(isset($_POST['submit'])) {
  
   
    $imgtitulo = $_FILES['img1']['name'];
    $imgTmp = $_FILES['img1']['tmp_name'];
    $imgSize = $_FILES['img1']['size'];

    if($imgtitulo){

        $imgExt = strtolower(pathinfo($imgtitulo, PATHINFO_EXTENSION));
        $allowExt  = array('jpeg', 'jpg', 'png', 'gif');
        $userPic = time().'_'.rand(1000,9999).'.'.$imgExt;
        if(in_array($imgExt, $allowExt)){
            if($imgSize < 500000000){
                unlink($upload_dir.$row['img']);
                move_uploaded_file($imgTmp ,$upload_dir.$userPic);
            }else{
                $errorMsg = 'Erro! Imagem ocupa muito esaco';
            }
        }else{
            $errorMsg = 'Insira uma imagem valida!';
        }
    }else{

        $userPic = $imagem;
    }
    

    $query = "UPDATE tbinstituicoes SET imagem = '$userPic' WHERE instid = '$instid' ";
	$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
	if (mysqli_affected_rows($conn) > 0 ) {
        $_SESSION['info'] = "<b style='color: blue;'>Imagem alterada com sucesso!</b>";
        header("location: index.php");
	}
	else {
		"<script>alert('Tente novamente!'); </script> " ;
	}

}

?>