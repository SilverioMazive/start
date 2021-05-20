<?php

include "controller/permissao.php";

if(isset($_POST['submit']) && $_POST['level'] != "none") 
{

  $palavra =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['palavra'])));
  $level = (int)str_replace(' ', '', intval($_POST['level']));
  $acertos = '0';
  $erros = '0';
          

  $dataSeca = new DateTime('now');
  $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
  $data = $dataSeca->format('Y-m-d H:i');  
      

//$query = "INSERT INTO tbpalavras(palavra, acertos, erros, level, data) VALUES ('$palavra' , '$acertos', '$erros', '$level', '$data')";
$sql = "select * from tbpalavras where palavra=".$palavra;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }else {
            
        }
  $query = "INSERT INTO tbpalavras(palavra, acertos, erros, level, data) SELECT '$palavra' , '$acertos', '$erros', '$level', '$data'
  WHERE NOT EXISTS(SELECT * FROM tbpalavras WHERE palavra='$palavra')";
  $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
  if (mysqli_affected_rows($conn) > 0 ) {
      
      echo "<script>alert('Inserida com sucesso!'); </script>";

  }
  else {
      "<script>alert('Erro, tente novamente!');</script>";
  }
}
else
{
  "<script>alert('Selecione um nivel!');</script>";
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
  <title>Adicionar Palavra</title>
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
      <h1 class="h3 mb-0 text-gray-800">Palavras</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Adicionar Palavra</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <label for="exampleInputEmail1">Palavra</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="palavra" aria-describedby="emailHelp"
                  placeholder="Palavra">                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Nivel</label>
                  <select name="level" id="category" class="form-control">
                    <option value="none">--Selecione o nivel--</option>
                    <option value="0"> #0</option>
                    <option value="1"> #1 </option>
                    <option value="2"> #2</option>
                    <option value="3"> #3</option>
                    <option value="4"> #4</option>
                  </select>
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
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Ultimas Palavras</h6>
        <a class="m-0 float-right btn btn-danger btn-sm" href="editar.php">Ver todas <i
            class="fas fa-chevron-right"></i></a>
      </div>
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th class="diminuirtexto">Palavra</th>  
              <th>Nivel</th>                        
              <th>Acertos</th>
              <th>Erros</th> 
              <th>Editar</th> 
            </tr>
          </thead>
          <tbody>
            <?php
              
           $sql2 = "SELECT * FROM tbpalavras order by palavraid desc limit 10";
          $result2 = mysqli_query($conn, $sql2);

          if(mysqli_num_rows($result2)){
            while($row2 = mysqli_fetch_assoc($result2))
            {
              $palavraid = $row2['palavraid'];
              $palavra = $row2['palavra'];
              $level = $row2['level'];
              $acertos = $row2['acertos'];     
              $erros = $row2['erros'];                        
            ?>
            <tr>
              <td class="diminuirtexto"><?php echo $palavra; ?></td>                        
              <td><?php echo $level; ?></td>
              <td><?php echo $acertos; ?></td>
              <td><?php echo $erros; ?></td>
              <td><a href="editarprocess.php?id=<?php echo $row2['palavraid'] ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"> Editar</i></a></td>                        
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