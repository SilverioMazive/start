<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
if (isset($_SESSION['admin'])) {

 
	
}
else {
	header("location: admin.php");
}


$upload_dir = '../../uploads/';


if (isset($_SESSION['admin'])) {

    if(isset($_POST['submit'])) {
        $nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
        
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

        $dataSeca = new DateTime('now');
        $data = $dataSeca->format('Y-m-d H:i');  
            
        $query = "INSERT INTO tbartist(nome, img, data) VALUES ('$nome' , '$img' , '$data') " ;
        $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            echo "<script>alert('Inserido com sucesso!'); </script> " ;
        }
        else {
            "<script>alert('error, try again!');</script>";
        }
    }
}
 

?>


<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
	<?php
			include "header.php";
		?>

		<main>
			<div class="container">
				<h2>Add Artist...</h2>
				<form method="post" enctype="multipart/form-data" action="addartist.php">

					<p>
						<label>Nome</label>
						<input type="text" name="nome" required="">
					</p>
					<p>
						<label>Imagem</label>
						<input type="file" class="form-control" name="img1" value="">
					</p>
					
					<p>
						
						<input type="submit" name="submit" value="Submit">
					</p>
				</form>

				<br>
				<br>
				<a href="artistas.php">Todos artistas</a>
			</div>
		</main>

		

	</body>
</html>
