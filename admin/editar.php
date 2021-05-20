<?php
//Esconde erros
// ini_set('display_errors', 0 );
// error_reporting(0);
?>
<?php

include "controller/permissao.php";


$estado = 'apagado';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];    
    $sql = "update questions
        set estado = '".$estado."'
        where question_number=".$id;
    if(mysqli_query($conn, $sql)){

      setcookie('pergunta','Pergunta apagada com sucesso', (time() + (3)));//3 segundinhos
      header('location:editar.php');
    }    
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
    <title>Todas perguntas</title>
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
            <!--<h1 class="h3 mb-0 text-gray-800">Plataforma de desafios</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>-->
          </div>

          <div class="row mb-3">
                        
            

            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-danger">
                    <?php 
                      if (isset($_COOKIE['pergunta'])) 
                      {
                        print($_COOKIE['pergunta']);
                      }
                    ?>
                  </h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Imagem</th>
                        <th>Pergunta</th>
                        <th>Nilvel</th>
                        <th>Data</th>
                        <th>Detalhes</th>  
                        <th>Apagar</th> 
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php
                        
                     $sql2 = "SELECT * FROM questions where estado!='apagado' order by question_number desc";
                    $result2 = mysqli_query($conn, $sql2);

                    if(mysqli_num_rows($result2)){
                      while($row2 = mysqli_fetch_assoc($result2))
                      {
                        $question_number = $row2['question_number'];
                        $image = $row2['image'];
                        $question = $row2['question'];     
                        $dataprint = $row2['data'];                          
                      ?>
                      <tr>              
                        <td><img src="<?php echo $upload_dir.$image; ?>" style="object-fit: cover; width: 50px; height: 50px;"></td>
                        <td><?php echo $question; ?></td>
                        <td><?php echo $row2['level']; ?></td>
                        <td><?php echo $dataprint; ?></td>
                        <td><a href="detalhes.php?id=<?php echo $row2['question_number'] ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"> Detalhes</i></a></td> 
                        <td><a href="editar.php?delete=<?php echo $row2['question_number'] ?>" onclick="return confirm('Tens certeza que vais apagar esta pergunta?')" class="btn btn-sm btn-danger"><i class="fa fa-trash"> Apagar</i></a></td>                        
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


                        
          </div>
          <!--Row-->

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