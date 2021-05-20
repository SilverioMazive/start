<?php
//Esconde erros
ini_set('display_errors', 0 );
error_reporting(0);
?>
<?php

include "controller/permissao.php";

$estado = 'apagado';

if(isset($_GET['id']))
{

  $id = (int)str_replace(' ', '', intval($_GET['id']));

  $sql2 = "SELECT * FROM questions
  where questions.question_number=".$id;
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($result2);
  if ($result2) 
  {
    $question = $row2['question'];
    $descricao = $row2['descricao'];
    $image = $row2['image'];
    $question_number = $row2['question_number'];
  }
  else
  {
    header("location: editar.php");
  }
}
else
{
  header("location: editar.php");
}

  // unset($_COOKIE['pergunta'])

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
    <title><?php print($question); ?></title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style type="text/css">
      .diminuirtexto
      {
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
      }
    </style>

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
            <h1 class="h3 mb-0 text-gray-800"><?php print($question); ?></h1>
            <!-- <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item" aria-current="page">Bootstrap UI</li>
              <li class="breadcrumb-item active" aria-current="page">Popovers</li>
            </ol> -->
          </div>

          <!-- Row -->
          <div class="row">
            <center>
              
            </center>
            <div class="col-lg-6">
              <!-- Popover basic -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"></h6>
                </div>
                <center>
                  <div class="card-body">
                    <img src="<?php echo $upload_dir.$image; ?>" style="width: 300px; height: 300px; object-fit: contain;">
                  </div>
                </center>
              </div>
            </div>
            <div class="col-lg-6">
              <!-- Dismiss on next click -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Opções de escolha</h6>
                </div>
                <div class="card-body">
                  <ul style="list-style: none;">
                    <?php
                      $sql3 = "SELECT * FROM choices where question_number=$question_number";
                      $result3 = mysqli_query($conn, $sql3);
                      if(mysqli_num_rows($result3))
                      {
                        while($row3 = mysqli_fetch_assoc($result3))
                        {
                          $is_correct = $row3['is_correct'];
                    ?>
                      <li >
                        <?php print($row3['choice']); ?>
                        <?php if ($is_correct == '1') 
                          {
                        ?>
                         <img src="../img/certo.png" alt="Resposta" style="width:auto; max-height:28px; margin-left:3px;" /> 
                        <?php
                          }
                          else
                          { 
                        ?>
                          <img src="../img/cross-check.jpg" alt="Resposta" style="width:auto; max-height:18px; margin-left:3px;"  />
                        <?php 
                          } 
                        ?>
                      </li>
                      <hr>
                    <?php
                        }                        
                      }
                    ?>
                    
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-lg-12">
              <!-- Four directions -->
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Descrição da resposta certa</h6>
                </div>
                <div class="card-body">
                  <p><?php print($descricao); ?></p>
                </div>
              </div>
            </div>
          </div>
          <!-- Row-->

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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>