<?php

  include "controller/permissao.php";

  include "model/dbLogin.php";
  include "model/User.php";

  $user = new User($db);

  if(isset($_POST['submit'])){
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $reppassword = mysqli_real_escape_string($conn,$_POST['reppassword']);
    $passwordlst = mysqli_real_escape_string($conn,$_POST['passwordlst']);

    
    if($_POST['password'] != $_POST['reppassword'])
    {
        $error = 'Os PINs introduzidos são diferentes!';
    }
    else
    {

      if($passwordlst == 'felicidade1&$')
      {
        // Registrasi user baru
        if($user->updatesenha($socioid, $password)){
            // Jika berhasil set variable success ke true
            if($success = true)
            {
              $_SESSION['info'] = '<b>Senha alterada com sucesso!</b>';
              header("location: index.php");
            }
            else
            {
                // Jika gagal, ambil pesan error
                $error = $user->getLastError();
            }
        }else{
            // Jika gagal, ambil pesan error
            $error = $user->getLastError();
        }
      }
        
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
  <title>Alterar Senha</title>
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
      <h1 class="h3 mb-0 text-gray-800">Alterar Senha</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Alterar Senha</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="alterarsenha.php">

              <div class="form-group">
                <label for="exampleInputEmail1">Antigo Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" name="passwordlst" aria-describedby="emailHelp"
                  placeholder="Password">                
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Novo Password</label>
                <input type="password" class="form-control" id="exampleInputEmail1" name="password" aria-describedby="emailHelp"
                  placeholder="Password">                
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Repetir Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="reppassword" 
                placeholder="Repetir Senha">
              </div>

              <input type="submit" name="submit" class="btn btn-primary" value="Atualizar Password">
            </form>
          </div>
        </div>

      </div>

      
    </div>
   <?php include "sair.php"; ?>
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