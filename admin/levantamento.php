<?php

include "controller/permissao.php";

if(isset($_POST['submit']))
{
        
    $telefonelevantamento = '258'.$telefone;  
    //$telefonelevantamento = '258'.$telefone;   
    $valorLevant = $_POST['valor'];          
    $nome = 'HakelaBetLevantar';
    $dataSeca = new DateTime('now');
    $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
    $datalev = $dataSeca->format('Y-m-d H:i:s');       
    
    //ADICIONAR ESTE TESTO AGORA ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    if (preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $valorLevant) || preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $telefonelevantamento) ) {
        
    }
    else 
    {
        header("location: index.php");
    }

    $ValorDisponivel = $ganho;
    $usuarioid = '2';

    // if($valorLevant <= $ValorDisponivel)
    // {

      $url = 'https://pagamento.musicambicano.com/b2c.php';
      $data = array('id' => $idPost);//Se forem varios parametros $data = array('id' => $idPost, 'id2' => $idPost2);
      
      // $url = 'http://localhost:8090/dreamseeder/api/c2b.php';
      // $idPost = '1';
      // $data = array('id' => $idPost);
      $data = array('phone_number' => $telefonepagamento,'amount' => $valor, 'nome' => $nome);
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
      
  
      //AQUI FILTRAR COM IF PARA DEPOIS PROCESSAR O PAGAMENTO    
      $obj = json_decode($resposta);
      $respostaDoMpesa = $obj->{'output_ResponseCode'};


      if($respostaDoMpesa == 'INS-0')
      {
      
          $sqlInsert = "INSERT INTO tblevantamento(telefone, valor, data)
              values('".$telefonelevantamento."', '".$valorLevant."', '".$datalev."')";
              $resultInsert = mysqli_query($conn, $sqlInsert);
          
          $sqlNosso = "UPDATE tbusuarios set ganho=ganho-'$valorLevant' 
          where uid='$userid'";
          $resultNosso = mysqli_query($conn, $sqlNosso);        

          $info = 'Levantamento efectuado com sucesso, o valor sera enviado para a conta do MPesa do contacto '.$telefonelevantamento;
          setcookie('info', $info, (time() + 10));
          header("location: index.php");                  

      }
      else
      {
          $error = $respostaDoMpesa;
      }
    // }
    // else
    // {
    //     $error = 'Não tens saldo suficiente para efectuar esse levantamento';
    // }
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
  <title>Levantamento</title>
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
            <h6 class="m-0 font-weight-bold text-primary">Efectuar Levantamento (Saldo => <?php echo($ganho); ?> Mt)</h6>
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="">

              <div class="form-group">
                <center>
                  <img src="../img/M-pesa-logo.png" alt="MPESA" style="max-width:120px; height:120px;" />
                </center>
              </div>    

              <div class="form-group">
                <label for="exampleInputEmail1">Valor a levantar (Mt)</label>
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

      <!-- Invoice Example -->
            <div class="row mb-3" id="pacote">
                        
          
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Lista de levantamentos</h4>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Telefone</th> 
                        <th>Valor</th> 
                        <th>Data</th> 
                      </tr>
                    </thead>
                    
                    <tbody>
                      <?php

                      $telefonelev = '258'.$telefone;
                        
                      $sql2 = "SELECT * FROM tblevantamento where tblevantamento.telefone='$telefone'";
                        
                      $result2 = mysqli_query($conn, $sql2);
                      if(mysqli_num_rows($result2)){
                        while($row2 = mysqli_fetch_assoc($result2))
                        {
                          // $idpacote = $row2['idpacote'];
                          
                          $telefone = $row2['telefone'];
                          $valor = $row2['valor'];
                          
                          $dataprint = $row2['data'];
                                             
                      ?>
                      <tr>
                                            
                        <td><?php echo $telefone; ?></td>
                        <td><?php echo $valor; ?></td>
                        <td><?php echo $dataprint; ?></td>
                                                
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