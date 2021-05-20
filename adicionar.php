<?php

include "controller/permissao.php";
$upload_dir = 'uploads/';


if(isset($_POST['submit'])) 
{

  $titulo = htmlentities(mysqli_real_escape_string($conn , $_POST['titulo']));

  $precompesalease = (int)str_replace(' ', '', intval($_POST['precompesalease']));
  $precopaypallease = (int)str_replace(' ', '', intval($_POST['precopaypallease']));

  if ($_POST['precompesapremium']  != "") 
  {
    $precompesapremium = (int)str_replace(' ', '', intval($_POST['precompesapremium']));
    $precopaypalpremium = (int)str_replace(' ', '', intval($_POST['precopaypalpremium']));
  }
  else
  {
    $_POST['precompesapremium'] = "0";
    $_POST['precopaypalpremium'] = "0";
  }

  if ($_POST['precompesaexclusivo'] != "") 
  {
    $precompesaexclusivo = (int)str_replace(' ', '', intval($_POST['precompesaexclusivo']));
    $precopaypalexclusivo = (int)str_replace(' ', '', intval($_POST['precopaypalexclusivo']));
  }
  else
  {
    $_POST['precompesaexclusivo'] = "0";
    $_POST['precopaypalexclusivo'] = "0";
  }


  $limite = (int)str_replace(' ', '', intval($_POST['limite']));
  $downloads = '0';
  $ganho = '0';
  $estado = 'disponivel';
          

  $dataSeca = new DateTime('now');
  $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
  $data = $dataSeca->format('Y-m-d H:i:s');  

 
  //Introduzir para lease
  $leasetitulo = $_FILES['lease']['name'];
  $leaseTmp = $_FILES['lease']['tmp_name'];
  $leaseSize = $_FILES['lease']['size'];

  
  //ADICIONANDO O  Lease
  $leaseExt = strtolower(pathinfo($leasetitulo, PATHINFO_EXTENSION));
  $allowleaseExt  = array('zip', 'rar');
  $userlease = time().'_'.rand(1000,9999).'.'.$leaseExt;

  if(in_array($leaseExt, $allowleaseExt)){

    if($leaseSize < 500000000){
      move_uploaded_file($leaseTmp ,$upload_dir.$userlease);
    }else{
      $errorMsg = 'O tamanho do documento é grande deve ser menos que 500MB (Megabytes)';
    }
  }else{
    $errorMsg = 'Por favor selecione uma imagem valida';
  }

  


  //ADICIONANDO O  Premium
  if(!isset($_FILES['premium']) || $_FILES['premium']['error'] == UPLOAD_ERR_NO_FILE)
  {
    $userpremium = "nenhum ficheiro";
  }
  else
  {

    //Introduzir para Premium
    $premiumtitulo = $_FILES['premium']['name'];
    $premiumTmp = $_FILES['premium']['tmp_name'];
    $premiumSize = $_FILES['premium']['size'];

    $premiumExt = strtolower(pathinfo($premiumtitulo, PATHINFO_EXTENSION));
    $allowpremiumExt  = array('zip', 'rar');
    $userpremium = time().'_'.rand(1000,9999).'.'.$premiumExt;

    if(in_array($premiumExt, $allowpremiumExt)){

      if($premiumSize < 500000000){
        move_uploaded_file($premiumTmp ,$upload_dir.$userpremium);
      }else{
        $errorMsg = 'O tamanho do documento é grande deve ser menos que 500MB (Megabytes)';
      }
    }else{
      $errorMsg = 'Por favor selecione uma imagem valida';
    }
  }


  

  //ADICIONANDO O  Exclusivo
  if(!isset($_FILES['exclusivo']) || $_FILES['exclusivo']['error'] == UPLOAD_ERR_NO_FILE)
  {
    $userexclusivo = "nenhum ficheiro";
  }
  else
  {

    //Introduzir para Exclusivo
    $exclusivotitulo = $_FILES['exclusivo']['name'];
    $exclusivoTmp = $_FILES['exclusivo']['tmp_name'];
    $exclusivoSize = $_FILES['exclusivo']['size'];

    $exclusivoExt = strtolower(pathinfo($exclusivotitulo, PATHINFO_EXTENSION));
    $allowexclusivoExt  = array('zip', 'rar');
    $userexclusivo = time().'_'.rand(1000,9999).'.'.$exclusivoExt;

    if(in_array($exclusivoExt, $allowexclusivoExt)){

      if($exclusivoSize < 500000000){
        move_uploaded_file($exclusivoTmp ,$upload_dir.$userexclusivo);
      }else{
        $errorMsg = 'O tamanho do documento é grande deve ser menos que 500MB (Megabytes)';
      }
    }else{
      $errorMsg = 'Por favor selecione uma imagem valida';
    }
  }


  $sql = "insert into tbprod (titulo, precompesalease, precompesapremium, precompesaexclusivo, precopaypallease, precopaypalpremium, precopaypalexclusivo, lease, premium, exclusivo, estado, downloads, limite, ganho, data)
      values('".$titulo."', '".$precompesalease."', '".$precompesapremium."', '".$precompesaexclusivo."', '".$precopaypallease."', '".$precopaypalpremium."', '".$precopaypalexclusivo."', '".$userlease."', '".$userpremium."', '".$userexclusivo."', '".$estado."', '".$downloads."', '".$limite."', '".$ganho."', '".$data."')";
  $result = mysqli_query($conn, $sql);
  if($result){
    $_SESSION['info'] = ' adicionada com sucesso';
    header('Location: index.php');
  }else{
    $errorMsg = 'Error '.mysqli_error($conn);
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
  <title>Adicionar </title>
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
      <h1 class="h3 mb-0 text-gray-800"></h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

  <center>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar para Venda</h6>
          </div>

          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <label for="exampleInputEmail1">Nome do produto</label>
                <select name="regimeid" class="form-control" id="category">
                  <option value="0">-- Selecione --</option>
                  <option value="<?php echo $row['categoriaid'] ?>">Banana</option>
                  <option value="<?php echo $row['categoriaid'] ?>">Matapha</option>
                  <option value="<?php echo $row['categoriaid'] ?>">Goiaba</option>
                  <option value="<?php echo $row['categoriaid'] ?>">Couve</option>
                  <option value="<?php echo $row['categoriaid'] ?>">Alface</option>
                    
                  </select>              
              </div>  
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Preço de venda (Meticais)</label>
                   <input type="number" pattern="[0-9]" class="form-control" name="precompesalease" placeholder="Introduza o preço de venda" value="">
              </div>
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Categoria do produto</label>
                <select name="regimeid" class="form-control" id="category">
                  <option value="0">-- Selecione --</option>
                  <?php
                    $sql = "SELECT * FROM tbcategorias";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                      while($row = mysqli_fetch_assoc($result)){
                  ?>
                    <option value="<?php echo $row['categoriaid'] ?>"><?php echo $row['nomecat'] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
              </div>
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Quantidade</label>
                <input type="number" pattern="[0-9]" class="form-control" name="limite" placeholder="Qual é a quantidade do produto disponvel?" value="" style="margin-bottom: 4px;">
                <select name="regimeid" class="form-control" id="category">
                  <?php
                    $sql = "SELECT * FROM tbquantificadores order by quantificadorid asc";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                      while($row = mysqli_fetch_assoc($result)){
                  ?>
                    <option value="<?php echo $row['quantificadorid'] ?>"><?php echo $row['quantificador'] ?></option>
                  <?php
                      }
                    }
                  ?>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Dias da validade</label>
                   <input type="number" pattern="[0-9]" class="form-control" name="precompesalease" placeholder="Numero de dias em que o produto estará em boa conservação" value="">
              </div>
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Imagens do produto</label>
                <input type="file" name="imageFile[]" required multiple class="form-control">
              </div>
              <br>
              <div class="form-group">    
               <label for="exampleInputEmail1">Descrição do produto</label>
               <br>           
                <textarea name="descricao"></textarea>
              </div>
              <br>
              <input type="submit" name="submit" class="btn btn-primary" value="Adicionar">
              <br>
            </form>
          </div>
        </div>

      </div>
    </div>

  </center>

    <?php include "sair.php"; ?>

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

  <script src="tinymce/js/tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({selector:'textarea'});
  </script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>