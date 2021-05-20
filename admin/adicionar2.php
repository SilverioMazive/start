<?php

    include "controller/permissao.php";

    //Pegando o novo id
	$sql2 = "SELECT * FROM questions order by question_number DESC limit 1";
	$result2 = mysqli_query($conn, $sql2);
	$row2 = mysqli_fetch_assoc($result2);
	$question_number = $row2['question_number'] + 1;

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

	if ($_POST) {

    		if ($_FILES["file"]["error"] > 0) {
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

    			//Pegando os dados do formulario
    			$pergunta = $_POST['pergunta']; 
				$correct = $_POST['correct']; 
				$catid = $_POST['catid']; 
				$descricao = $_POST['descricao']."."; 
				$estado = 'disponivel';

                //Inserindo as informacoes na base de dados
                $number = count($_POST["name"]);
				//if($number > 1)
				if($number > 0)
				{
					for($i=0; $i<$number; $i++)
					{
						if(trim($_POST["name"][$i] != ''))
						{
							//Aqui para fazer concidir a opcao certa com o numero do indice do textfield
							if (($i + 1) == $_POST['correct']) 
							{
								$correct = '1';
							}
							else
							{
								$correct = '0';
							}


							 $sql = "insert into choices (choice, question_number, is_correct)
							      values('".$_POST["name"][$i]."', '".$question_number."', '".$correct."')";
							  $result = mysqli_query($conn, $sql);
							  if($result)
							  {
							  	//Aqui adicionar a propria pergunta
							  	 // $sqlp = "insert into questions (question, descricao, catid, image, data)
							    //   values('".$pergunta."', '".$descricao."', '".$catid."', '".$nomereal."', '".$datanow."')";
							    $sqlp = "insert into questions (question, descricao, catid, image, estado, data)
							      select '".$pergunta."', '".$descricao."', '".$catid."', '".$nomereal."', '".$estado."', '".$datanow."'
							      where not exists(select * from questions where image='".$nomereal."')";
								  $resultp = mysqli_query($conn, $sqlp);
								  if($resultp)
								  {
								  	$_SESSION['info'] = '<b>Pergunta adicionada com sucesso!</b>';
							    	header('Location: index.php');
								  }
								  else
								  {
							    	$errorMsg = 'Error '.mysqli_error($conn);
							      }
							  }
							  else
							  {
							    $errorMsg = 'Error '.mysqli_error($conn);
							  }
						}
					}
					
				}

                ?>
                    <!-- <script type="text/javascript">window.location = "testes.php";</script> -->
                <?php

    		}else {
        			$error = "Uploaded image should be jpg or gif or png";
    		}
	}
?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="addfield/bootstrap/css/bootstrap.min.css" />
		<script src="addfield/bootstrap/js/bootstrap.min.js"></script>
		<script src="addfield/jquery/jquery-3.2.1.min.js"></script>
	</head>
	<body>
		<div class="container">

			<?php
        		if($_POST)
        		{
            		if ($error) 
            		{
                		?>
                		<label class="error"><?php echo $error; ?></label>
            <?php
            		}
            	}
        	?>
			
			<h2 align="center" style="color: green;">Adicionar Pergunta</h2><br />
			<div class="form-group">
				<form name="add_name" id="add_name" method="POST" action="adicionar2.php" enctype="multipart/form-data">
					<div class="form-group">             
		               <textarea name="pergunta" rows="4" class="form-control" placeholder="Adicionar a pergunta"></textarea>
		            </div>
                    <center>
                    	<h4>Adicionar opções</h4>
                    </center>
					<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="name[]" placeholder="Inserir a opção" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success"><b style="font-size: x-large;">+</b></button></td>
							</tr>
						</table>
					</div>
					<div class="form-group">
		                <label for="exampleInputEmail1">Numero da opção correcta</label>
		                <input type="number" class="form-control" pattern="^[0-9]" id="exampleInputEmail1" name="correct" aria-describedby="emailHelp"
		                  placeholder="Inserir o numero da opção correcta">                
	                </div>  
                    <div class="form-group">
	                    <label for="exampleFormControlTextarea1">Categoria</label>
	                    <select name="catid" id="category">
	                        <option value="0">--Selecionar a categoria--</option>
	                        <?php
		                        $sql2 = "SELECT * FROM categorias where estado !='apagado'";
		                        $result2 = mysqli_query($conn, $sql2);
		                        if(mysqli_num_rows($result2)){
		                          while($row2 = mysqli_fetch_assoc($result2)){
	                        ?>
	                        <option value="<?php echo $row2['catid'] ?>"><?php echo $row2['nome'] ?></option>
	                        <?php
		                          }
		                        }
	                        ?>
	                    </select>
                    </div>
		            <center><h6 style="color: blue;">Explicação da opção correcta</h6></center>
		            <div class="form-group">             
		               <textarea name="descricao" rows="4" class="form-control" placeholder="Inserir uma explicação!"></textarea>
		            </div>

		            <div class="form-group">
	                    <label for="exampleFormControlTextarea1">Escolher a imagem da pergunta</label>
	                    <input type="file" name="file" id="file" class="form-control">
	                </div>

	                <!-- <div class="form-group">
						<label for="exampleFormControlTextarea1">Escolher a imagem da pergunta</label>
						<input type="file" name="file" id="file" class="form-control" value="Selecionar a Imagem">
		            </div> -->
					<input type="submit" name="submit" class="btn btn-info btn-lg" value="Confirmar" />
					<!-- <input type="button" name="submit" id="submit" class="btn btn-info btn-lg" value="Confirmar" /> -->
					<br>
					<br>
				</form>
			</div>
		</div>
	</body>
</html>

<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Inserir a opção" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	$('#submit').click(function(){		
		$.ajax({
			url:"adicionarprocess.php",
			method:"POST",
			data:$('#add_name').serialize(),
			success:function(data)
			{
				alert(data);
				$('#add_name')[0].reset();
			}
		});
	});
	
});
</script>





