<?php



include "connection.php";
include "_mozamor_%.php";
session_start();

	$telefone = $_GET['telefone'];

 	$sql = "SELECT * FROM tbusuario
	    WHERE  telefone='$telefone'";
	$result = mysqli_query($conn, $sql);
	$row  = mysqli_fetch_assoc($result);
	$saldo = $row['saldo'];
	$nome = $row['nome'];
	$_SESSEION['nome'] = $nome;
	$_SESSEION['telefone'] = $telefone;

?>

<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/style1.css">
	</head>

	<body>
		

	<?php
		include "header.php";
	?>
	<br>
	<br>

	<center><h2>Saldo => <?php print($saldo); ?></h2></center>
	
	<br>
	<hr>
   <!-- Apostas -->
   <center>
   	<h2>Apostas</h2>
        <table class="data-table">
            <thead>
                <tr>
					<th>Jogo</th>
					<th>Valor</th>
					<th>Data</th>			
				</tr>
            </thead>
            <tbody>
				<?php		
					
					$_SESSEION['devolver'] = $telefone;

					$sqlvale = "SELECT * FROM tbapostas
					    WHERE  telefone='$telefone' order by apostaid desc LIMIT 10";
					$resultvale = mysqli_query($conn, $sqlvale);
					if (mysqli_num_rows($resultvale) > 0) 
					{

						while($row1  = mysqli_fetch_assoc($resultvale)){
							
							$jogo = $row1['jogo'];
							$valordaaposta = $row1['valordaaposta'];
							$data = $row1['data'];

							echo "<tr>";
							echo "<td>$jogo</td>";
							echo "<td>$valordaaposta</td>";
							echo "<td>$data</td>";
							echo "</tr>";
								
				?>                                            
                <?php

							
						}
					}

				?>
            </tbody>                                        
        </table>
	</center>
	<br>
	<hr>

	<!-- Recarregamentos -->
   <center>
   	<h2>Recarregamentos</h2>
        <table class="data-table">
            <thead>
                <tr>
					<th>Valor</th>
					<th>Data</th>			
				</tr>
            </thead>
            <tbody>
				<?php		
					$data =  new DateTime('now');
					$datareal = $data->format('Y-m-d H:i:s'); 
					$telefone = $_GET['telefone'];

					$sqlvale = "SELECT * FROM tbrecarregamento
					    WHERE  telefone='$telefone' order by recarregamentoid desc LIMIT 10";
					$resultvale = mysqli_query($conn, $sqlvale);
					if (mysqli_num_rows($resultvale) > 0) 
					{

						while($row1  = mysqli_fetch_assoc($resultvale)){
							
							$valor = $row1['valor'];
							$data = $row1['data'];

							echo "<tr>";
							echo "<td>$valor</td>";
							echo "<td>$data</td>";
							echo "</tr>";
								
				?>                                            
                <?php

							
						}
					}

				?>
            </tbody>                                        
        </table>
	</center>
	<br>
	<hr>

	<!-- Apostas -->
   <center>
        <a href="devolver.php?telefone=<?php print($_GET['telefone']);?>">
	         <h3>Devolver Saldo</h3>
	     </a>
	</center>
	<br>
	<hr>

	</body>
</html>