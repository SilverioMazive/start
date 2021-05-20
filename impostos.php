<?php

include "controller/permissao.php";

if(isset($_POST['submit']))
{
  $impostoid = $_POST['impostoid'];
  $sql4 = "SELECT * FROM tbimpostos where impostoid='$impostoid'";
  $result4 = mysqli_query($conn, $sql4);
  if(mysqli_num_rows($result4))
  {
    while($row4 = mysqli_fetch_assoc($result4))
    {

      $valor = $row4['preco'];
      $duracao = $row4['duracao'];
      $datar =  new DateTime('now');
      $datar->modify('+'.$duracao.' days');
      $datar->setTimezone(new DateTimeZone('Africa/Maputo'));
      $datafim = $datar->format('Y-m-d H:i:s');

      header("location: indexp.php".$valor);

      if ($ganho >= $valor) 
      {
        //PROCESSAMENTO DO SUCESSO DO PAGAMENTO DO CLIENTE 
        $sqlInsert2 = "UPDATE tbusuarios SET ganho=ganho-'$valor' where uid='$userid'";
        $resultInsert2 = mysqli_query($conn, $sqlInsert2);

        if($resultInsert2)
        {
          $sqlInsert5 = "INSERT INTO tbimpostospay (impostoid, uid, data, datafim) 
                          VALUES ('$impostoid', '$userid', '$datanow', '$datafim')";
          $resultInsert5 = mysqli_query($conn, $sqlInsert5);

          if($resultInsert5)
          {
            setcookie('info', "<b style='color: blue;'>Imposto pago com sucesso, para levantar o recibo dirija-se ao centro de atendimento do mercado a que pertence.</b>", (time() + 5));
            header("location: index.php");
          }
          else
          {
            header("location: index.php");

          }          
        }
        else
        {
          header("location: index.php");

        } 
      }
      else
      {
        include "pagamento.php"; 
      }
    }
  }
  else
  {
    setcookie('info', "<b style='color: blue;'>Sem registro do valor para pagar.</b>", (time() + 5));
    header("location: index.php");
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
  <title>Impostos</title>
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


<center>
  <!-- Container Fluid-->
  
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <!-- <h1 class="h3 mb-0 text-gray-800">Levantamento</h1>
      <ol class="breadcrumb">
       
      </ol> -->
    </div>

    <div class="row">
      <div class="col-lg-6">
        <!-- Form Basic -->
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Efectuar Pagamento do imposto de venda (Saldo => <?php echo($ganho); ?> Mt)</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <center>
                  <img src="../img/M-pesa-logo.png" alt="MPESA" style="max-width:120px; height:120px;" />
                </center>
              </div>  

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Tempo da validade do pagamento</label>
                 <select name="impostoid" class="form-control" id="category">
                  <option value="0">-- Selecione aqui --</option>
                  <?php
                    $sql2 = "SELECT * FROM tbimpostos order by impostoid Asc";
                    $result2 = mysqli_query($conn, $sql2);
                    if(mysqli_num_rows($result2)){
                      while($row2 = mysqli_fetch_assoc($result2)){
                  ?>
                    <option value="<?php echo $row2['impostoid'] ?>">Pagamento <?php echo $row2['periodo'] ?> (<?php echo $row2['preco'] ?> Mt)</option>
                    <?php
                      }
                    }
                    ?>
                </select>
              </div>
              <br>
              <div class="form-group">
                <label for="exampleInputEmail1">Numero para o pagamento</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="telefone" aria-describedby="emailHelp"
                  placeholder="(84 ou 85)" >                
              </div>     

              <input type="submit" name="submit" class="btn btn-primary" value="Confirmar">
            </form>
          </div>
          <p><span style="color: red;">NB:</span> Depois de efectuar o pagamento vai levantar o recibo no centro do mercado a que pertence.</p>
          
        </div>
      </div>  

      <!-- Invoice Example -->
            <div class="col-xl-8 col-lg-7 mb-4">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Lista de pagamentos de imposto</h6>
                  <!-- <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                      class="fas fa-chevron-right"></i></a> -->
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Codigo do bilhete</th>
                        <th>Periodo do imposto</th>
                        <th>Telefone do pagamento</th>
                        <th>Data</th>
                        <th>Expira</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $estado = 'desativado';
                        $sql = "SELECT * FROM (tbimpostospay inner join tbimpostos on tbimpostos.impostoid=tbimpostospay.impostoid)
                         where tbimpostospay.uid='$userid' order by tbimpostospay.impostopayid desc";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result))
                        {
                          while($row = mysqli_fetch_assoc($result))
                          {
                      ?>
                      <tr>
                        <td><?php echo $row['impostopayid'] ?></td>
                        <td><?php echo $row['periodo'] ?></td>
                        <td><?php echo $row['telefone'] ?></td>
                        <td><?php echo $row['data'] ?></td>
                        <td><?php echo $row['datafim'] ?></td>
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
    
<?php include "sair.php"; ?>
  </div>
  <!---Container Fluid-->
</center>




 
        
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