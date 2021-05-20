<?php

include "controller/permissao.php";


if(isset($_POST['submit'])){
        
    $telefone = $_POST['telefone'];
    $telefonepagamento = '258'.$_POST['telefone'];       
    $preco = $_POST['valor'];
    $nome = 'HakelaBet';
    
    $dataSeca = new DateTime('now');
    $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
    $dataDeCompra = $dataSeca->format('Y-m-d H:i:s');
    

    $url = 'https://bet.musicambicano.com/virmaz/index2.php';   
    $data = array('phone_number' => $telefonepagamento,'amount' => $preco, 'nome' => $nome);
    $options = array(
      'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
      )
    );
    $context = stream_context_create($options);
    $resposta = file_get_contents($url, false, $context);
    if($resposta === FALSE) {echo ('Errado!');}
      
    $obj = json_decode($resposta);
    $respostaDoMpesa = $obj->{'output_ResponseCode'};
  

    if($respostaDoMpesa == 'INS-0')
    {

      session_start();    

      $usuarioid = '2';
      $sqlInsert = "INSERT INTO tbrecarregamento(telefone, usuarioid, valor, data)
              values('".$_POST['telefone']."', '".$usuarioid."', '".$preco."', '".$dataDeCompra."')";
      $resultInsert = mysqli_query($conn, $sqlInsert);

      $sqlProd = "update tbsocios set ganho=ganho+'".$preco."', investimento=investimento+'".$preco."'
        where socioid=".$socioid;
      $resultProd = mysqli_query($conn, $sqlProd);          
      
      $_SESSION['info'] = 'Investimento feito com sucesso';
      header("location:index.php");  
      
    }
    else
    {
      echo($respostaDoMpesa);
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
  <title>Investir</title>
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
      <h1 class="h3 mb-0 text-gray-800">Investir</h1>
      <ol class="breadcrumb">
       
      </ol>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Efectuar Pagamento (Saldo => <?php echo($ganho); ?> Mt)</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <center>
                  <img src="../view/img/M-pesa-logo.png" alt="MPESA" style="max-width:120px; height:120px;" />
                </center>
              </div>  

              <div class="form-group">
                <label for="exampleInputEmail1">Valor a investir (Mt)</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="valor" aria-describedby="emailHelp"
                  placeholder="Valor" >                
              </div>              
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Numero de telefone</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="telefone" aria-describedby="emailHelp"
                  placeholder="(84 ou 85)" >                
              </div>     

              <input type="submit" name="submit" class="btn btn-primary" value="Confirmar">
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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>  
</body>

</html>