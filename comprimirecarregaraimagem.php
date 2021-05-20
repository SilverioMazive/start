<?php  

//ADICIONANDO A IMAGEM DE DESTAQUE
$name = ''; $type = ''; $size = ''; $error = '';
function compress_image($source_url, $destination_url, $quality) {

	$info = getimagesize($source_url);
		if ($info['mime'] == 'image/jpeg')
    			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
    			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
    			$image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);
	return $destination_url;
}

if ($_FILES["file"]["error"] > 0) 
{
    $error = $_FILES["file"]["error"];
} 
else if (($_FILES["file"]["type"] == "image/gif") || 
($_FILES["file"]["type"] == "image/jpeg") || 
($_FILES["file"]["type"] == "image/png") || 
($_FILES["file"]["type"] == "image/pjpeg")) 
{

    $imgnome = $_FILES['file']['name'];
    $ficheiroExt = strtolower(pathinfo($imgnome, PATHINFO_EXTENSION));

    $randomNumber = rand(0, 99999);
    $nomereal = (md5($randomNumber.$imgnome)).".".$ficheiroExt;//Nome da imagem para inserir na base de dados
    $url = $upload_dir.$nomereal;//Nome da imagem para inserir na base de dados

    $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80);
    $buffer = file_get_contents($url);
}else {
        $error = "Uploaded image should be jpg or gif or png";
}

?>


<form>
	<div class="form-group">
        <label for="exampleFormControlTextarea1">Escolher a imagem da pergunta</label>
        <input type="file" name="file" id="file" class="form-control">
    </div>

</form>


