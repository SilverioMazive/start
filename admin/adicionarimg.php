<?php

include "controller/permissao.php";
    
$upload_dir = '../uploads/';

if(isset($_POST['submit'])) {
    $nome =htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
    
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

    $datar =  new DateTime('now');
    $datar->setTimezone(new DateTimeZone('Africa/Maputo'));
    $datanow = $datar->format('Y-m-d H:i:s');

    $query = "INSERT INTO tbartist(nome, img, data) VALUES ('$nome' , '$nomereal' , '$datanow') " ;
    $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0 ) 
    {
      setcookie('info','Imagem inserida com sucesso', (time() + (15)));//15 Segundos
      header("location: adicionarimg.php");
    }
    else {
        "<script>alert('error, try again!');</script>";
    }
}

 

?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Adicionar Imagem</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "header.php"?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <?php include "header2.php"?>
          </ul>
        </nav>
        <!-- Topbar -->
<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Imagem</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>
   
    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar Imagem <span style="color: green;"><?php if(isset($_COOKIE['info'])){echo "(".$_COOKIE['info'].")";} ?></span></h6>

          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nome" aria-describedby="emailHelp"
                  placeholder="Nome da Imagem">                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Imagem</label>
                <input type="file" class="form-control" name="file" value="">
              </div>

              <input type="submit" name="submit" class="btn btn-primary" value="Adicionar">
            </form>
          </div>
        </div>

      </div>

      
    </div>
    <?php include "sair.php"; ?>

  </div>
  <!---Container Fluid-->


  <!-- Invoice Example -->
  <div class="col-xl-8 col-lg-7 mb-4">
    <div class="card">
      
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th class="diminuirtexto">Imagem</th>  
              <th>Nome</th>                        
              <th>Data</th>
              
            </tr>
          </thead>
          <tbody>
            <?php
              
           $sql2 = "SELECT * FROM tbartist order by artistid desc";
          $result2 = mysqli_query($conn, $sql2);

          if(mysqli_num_rows($result2)){
            while($row2 = mysqli_fetch_assoc($result2))
            {
              $artistid = $row2['artistid'];
              $img = $row2['img'];
              $imgsrc = "../uploads/";
              $nome = $row2['nome'];
              $data = $row2['data'];                            
            ?>
            <tr>
              <td class="diminuirtexto"><center><img src="<?php echo $imgsrc.$img; ?>" style="width: 100px; height: 100px; object-fit: contain;"></center></td>
              <td><?php echo $nome; ?></td>
              <td><?php echo $data; ?></td>                                
            </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer"></div>
    </div>
  </div>
        
      </div>
      <!-- Footer -->
      <?php include "footer.php"; ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>