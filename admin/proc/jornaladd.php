<?php

  $upload_dir = 'uploads/';
  $uploadDocpdf_dir = 'uploadDocpdf/';

  if (isset($_POST['jornalsub'])) {
    $titulo = $_POST['titulo'];
    $estado = 'indefinido';	
	$dataSeca = new DateTime('now');
	$data = $dataSeca->format('Y-m-d H:i:s');
	 

    $imgtitulo = $_FILES['image']['name'];
	$imgTmp = $_FILES['image']['tmp_name'];
	$imgSize = $_FILES['image']['size'];


	$docpdftitulo = $_FILES['docpdf']['name'];
	$docpdfTmp = $_FILES['docpdf']['tmp_name'];
	$docpdfSize = $_FILES['docpdf']['size'];



    


			//ADICIONANDO A IMAGEM DE DESTAQUE
			$imgExt = strtolower(pathinfo($imgtitulo, PATHINFO_EXTENSION));

			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');

			$userPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){

				if($imgSize < 50000000){
					move_uploaded_file($imgTmp ,$upload_dir.$userPic);
				}else{
					$errorMsg = 'O tamanho da imagem é grande deve ser menos que 50MB (Megabytes)';
				}
			}else{
				$errorMsg = 'Por favor selecione uma imagem valida';
			}


			//ADICIONANDO O JORNAL PDF
			$docpdfExt = strtolower(pathinfo($docpdftitulo, PATHINFO_EXTENSION));

			$allowdocpdfExt  = array('pdf', 'zip', 'rar', 'docx');

			$userdocpdf = time().'_'.rand(1000,9999).'.'.$docpdfExt;

			if(in_array($docpdfExt, $allowdocpdfExt)){

				if($docpdfSize < 500000000){
					move_uploaded_file($docpdfTmp ,$uploadDocpdf_dir.$userdocpdf);
				}else{
					$errorMsg = 'O tamanho do documento é grande deve ser menos que 500MB (Megabytes)';
				}
			}else{
				$errorMsg = 'Por favor selecione uma imagem valida';
			}
		


		if(!isset($errorMsg)){
			$sql = "INSERT into tbjornal (instid, titulo, image, docpdf, data, estado)
					values('$instid','$titulo', '$userPic', '$userdocpdf', '$data', '$estado')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$_SESSION['info'] = '<b style="color: blue;">Jornal adicionado com sucesso</b>';
				header('location: index.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  }
?>
