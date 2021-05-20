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
	            
				<?php		
					
					$sqlvale = "SELECT * FROM tbartist order by artistid desc";
					$resultvale = mysqli_query($conn, $sqlvale);
					if (mysqli_num_rows($resultvale) > 0) 
					{
						
						while($row1  = mysqli_fetch_assoc($resultvale))
						{
						
							$srcimg = "../../uploads/";
							$imagem = $srcimg.$row1['img'];
							$nome = $row1['nome'];

							echo "<img src='$imagem' height='200' width='200'>";
							echo "<br>";
							echo "<p>$nome</p>";
								
				?>                                            
	            <?php

							
						}
					}

				?>
		</center>
	</body>
</html>