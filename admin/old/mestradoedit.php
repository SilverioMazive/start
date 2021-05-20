<?php
 
  include "proc/permissao.php";
  include "proc/mestradoedit.php";

  if(isset($_GET['id']))
  {
    $mestradoid = $_GET['id'];
    $_SESSION['mestradoid'] = $mestradoid;    
  }
  else
  {
    header("location: mestradoall.php");
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
  <title>Adicionar Mestrado</title>
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
      <h1 class="h3 mb-0 text-gray-800">Adicionar Curso</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Mestrado</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="mestradoedit.php">
              <div class="form-group">
                <label for="exampleInputEmail1">Nome</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="nome" aria-describedby="emailHelp"
                  placeholder="Nome do curso de Mestrado" value="<?php echo $row['nome'] ?>">                
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Duração </label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="duracao" 
                placeholder="Duração do  curso (Ex: 3 anos)" value="<?php echo $row['duracao'] ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Condicoes de ingresso</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="condicoesdeingresso" 
                placeholder="Opcional" value="<?php echo $row['condicoesdeingresso'] ?>">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Área científica</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="areacientifica" 
                placeholder="Área científica (Ex: Direito, Informatica...)" value="<?php echo $row['areacientifica'] ?>">
              </div>
             
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Regime do curso</label>
                <select name="regimeid" id="category"  value="<?php echo $regimeid ?>">
                  <?php
                    $estado = 'desativado';
                    $sql = "SELECT * FROM tbregime where regimeid=".$regimeid;
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                      while($row = mysqli_fetch_assoc($result)){
                  ?>
                    <option value="<?php echo $row['regimeid'] ?>"><?php echo $row['nome'] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
              </div>

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Provincia</label>
                <select name="provinciaid" id="category"  value="<?php echo $provinciaid ?>">
                  <?php
                    $estado = 'desativado';
                    $sql = "SELECT * FROM tbprovincia where provinciaid=".$provinciaid;
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)){
                      while($row = mysqli_fetch_assoc($result)){
                  ?>
                    <option value="<?php echo $row['provinciaid'] ?>"><?php echo $row['nome'] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
              </div>
              <hr>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Descricao do Curso de Mestrado</label>
                <textarea name="descricao"><?php echo $descricao ?></textarea>
              </div>
              <hr>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Saídas profissionais</label>
                <textarea name="saidasprofissionais"><?php echo $saidasprofissionais ?></textarea>
              </div>

              <input type="submit" name="submit" class="btn btn-success" value="Adicionar Mestrado">
            </form>
          </div>
        </div>

      </div>

      
    </div>
   
  </div>
  <!---Container Fluid-->
        
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