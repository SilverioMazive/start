<?php session_start(); ?>
<?php include "connection.php";
 include "_mozamor_%.php";


	$bolaverde =htmlentities(mysqli_real_escape_string($conn , rand(1,60)));
	$bolaazul = htmlentities(mysqli_real_escape_string($conn , rand(1,60)));
	$bolageralnum = htmlentities(mysqli_real_escape_string($conn , rand(1,60)));
	
	$vencedores = '0';
	$faturamento = '0';

	$dataSeca = new DateTime('now');
	$datainicial = $dataSeca->format('Y-m-d H:i:s');  

	// $dias = '1';
	// $resultdata =  new DateTime('now');
	// $dataModificada = $resultdata->modify('+'.$dias.' day');
	// $datatermino = $dataModificada->format('Y-m-d H:i:s');


	//$sql = "select count(bsid) from tbbolasdasortex where datadotermino < '".$resultdata->format('Y-m-d H:i:s')."' and datainicial >".$telefone;
	$sql = "select * from tbbolasdasortex order by bsid desc limit 1";
	$result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
	  $row = mysqli_fetch_assoc($result);
	  $dataterminobd = $row['datatermino'];
	  $datainicialbd = $row['datainicial'];


	  $datainicialnew = $dataterminobd;

	  $horas = '4';
	  $brai = new DateTime($dataterminobd);
	  $brai2 = $brai->modify('+'.$horas.' hour');
	  $dataterminonew = $brai2->format('Y-m-d H:i:s');
	  

	  //Pegar a cor da bola
	  $sql3 = "select * from tbbolascores order by rand() limit 1";
	  $result3 = mysqli_query($conn, $sql3);
	  if (mysqli_num_rows($result3) > 0) {
		$row3 = mysqli_fetch_assoc($result3);
		$bolageralcor = $row3['nome'];
		
		$query = "INSERT INTO tbbolasdasortex (bolaverde, bolaazul, vencedores, datainicial, datatermino, bolageralnum, bolageralcor, faturamento) VALUES ('$bolaverde', '$bolaazul' , '$vencedores', '$datainicialnew', '$dataterminonew', '$bolageralnum', '$bolageralcor', '$faturamento') " ;
		$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
		if (mysqli_affected_rows($conn) > 0 ) {
			echo "<script>alert('Question successfully added'); </script> " ;
		}
		else {
			"<script>alert('error, try again!'); </script> " ;
		}
		
	}

    }else {
	  
		echo "<script>alert('Sem nenhum dado.'); </script> " ;
		
    }

	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Bola da sorte</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
    <link href="css/loadingjs.css" rel="stylesheet" />
<!--===============================================================================================-->
</head>
    <body>

<br>
<br>
        
    

	
<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="post" enctype="multipart/form-data" action="../../view/minhaconta.php">
					<span class="login100-form-title" style="font-size:large;">
                    Aceda o valor ganho na sua conta
					</span>

					
					<div class="wrap-input100 validate-input m-b-16" data-validate="">
                        <div class="row justify-content-center">
                        
						<div class="row justify-content-center">

							<!-- COLOCAR IMAGEM COM BALOES DE COMEMORACAO -->
							<img src="../../view/img/M-pesa-logo.png" alt="MPESA" style="max-width:120px;" /> 
							<br>
							<br>
							<h2>Parabens por venceres o jogo!</h2> 

                        </div>
						
                        </div>
					</div>
   

          <div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							
						</span>

						<a href="" class="txt2">
						
						</a>
					</div>

					<div class="container-login100-form-btn">
                    <button type="submit" class="login100-form-btn" name="submpagamento">Visualizar o dinheiro na conta</button>  					
          </div>
          <div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							
						</span>
					</div>
                </form>
                <br>
                
                <br>
			</div>
		</div>
	</div>



        

   <!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>
