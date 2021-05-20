<?php

 session_start();

 include "connection.php";
 include "_mozamor_%.php";

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
			<br>
			
                <!-- Highlights -->
               <center>
                                    <table class="data-table">
                                        <thead>
                                            <tr>
												<th>Cor da Bola</th>
												<th>Numero da Bola</th>
												<th>Data de validade</th>			
											</tr>
                                        </thead>
                                        <tbody>
											<?php		
												$data =  new DateTime('now');
												$datareal = $data->format('Y-m-d H:i:s'); 

												$sqlvale = "SELECT * FROM tbbolasdasortex
												    WHERE  datatermino >= '$datareal' AND   datainicial< '$datareal'";
												$resultvale = mysqli_query($conn, $sqlvale);
												if (mysqli_num_rows($resultvale) > 0) 
												{

												    $rowvale = mysqli_fetch_assoc($resultvale);
												    $bsid = $rowvale['bsid'];

												    $bsidnxt = $bsid;
												    
												    $sql1 = "SELECT * FROM tbbolasdasortex inner join tbbolascores 
												    on tbbolascores.nome=tbbolasdasortex.bolageralcor 
												    WHERE bsid < '$bsidnxt' order by bsid desc";
													$result1 = mysqli_query($conn, $sql1);
													if (mysqli_num_rows($result1) > 0) {
													
														while($row1  = mysqli_fetch_assoc($result1)){
															$data1 = $row1['datainicial'];
															$data11 = new DateTime($data1);
															$datainicial = $data11->format("Y-m-d H:i:s");

															$data2 = $row1['datatermino'];
															$data22 = new DateTime($data2);
															$datatermino = $data22->format("Y-m-d H:i:s");
															$cor = $row1['cor'];
															$bolageralnum = $row1['bolageralnum'];


															echo "<tr>";
															echo "<td>$cor</td>";
															echo "<td>$bolageralnum </td>";
															echo "<td>$datainicial <b>ás</b> $datatermino</td>";
															echo "</tr>";
															
											?>                                            
                                            <?php

														}
													}
												}

											?>
                                        </tbody>                                        
                                    </table>
                                
            
            
                

				
		</center>

		

	</body>
</html>