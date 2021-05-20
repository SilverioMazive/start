<?php 
session_start();
include "connection.php";
include "_mozamor_%.php";
include "adminhomeprocess.php";
if (isset($_SESSION['admin'])) {
} 
else {
header("location: admin.php");
}
?>

<?php

	if(isset($_POST['jogosconf']))
	{
		//FAZER UPDATE DO VALOR DOS JOGOS AQUI
		$valor = $_POST['valor'];
		$sqlNosso = "Update tbme set valor='".$valor."' 
            where meid=".$meid;
        $resultNosso = mysqli_query($conn, $sqlNosso);  


	}
?>


<!DOCTYPE html>
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

		<main>
		<div class="container">
		<h2>Espaço de Administração</h2>
		<?php

			echo "<br><br>";

			if(isset($_SESSION['info']))
			{
		?>
		<b>
			<?php 
				print($_SESSION['info']);
				unset($_SESSION['info']);
			?>
		</b>
		<?php

				echo "<br><br>";

			}
		?>
		</div>
		</main>


	
	
	<h1> Relatorio Geral</h1>
	<table class="data-table">
		<caption class="title"></caption>
		<thead>
			<tr>
				<th>Lucros</th>
				<td>
					<?php
						$lucros = $rowme['ganho'] - $rowme['perdas'];
						echo $lucros;
					?>
				</td>
			</tr>
			<tr>
				<th>Faturamento</th>
				<td><?php echo $rowme['ganho'];?></td>
			</tr><tr>
				<th>Perdas</th>
				<td><?php echo $rowme['perdas'];?></td>
			</tr>

			<tr>
				<th>Jogo das Palavras</th>
				<td><?php echo $rowpalavras['ganho'];?></td>
			</tr>

			<tr>
				<th>Jogos Preco</th>
				<td><?php echo $rowme['jogos'];?></td>
			</tr>


			<tr>
				<th>Levantamentos</th>
				<td><a href="levantamento.php"><?php echo $rowlevantamentos['levantamentos'];?></a></td>
			</tr><tr>
				<th>Clientes</th>
				<td><?php echo $rowusuarios['usuarios'];?></td>
			</tr>
			<tr>
				<th>Vencedores</th>
				<td><?php echo $rowvencedor['vencedor'];?></td>
			</tr><tr>
				<th>Perdedores</th>
				<td><?php echo $rowperdedor['perdedor'];?></td>
			</tr><tr>
				<th>Taixas Vodacom</th>
				<td><?php echo $rowme['taixasvodacom'];?></td>
			</tr>
			
		</thead>
		<tbody>
        
		</tbody>

		<br>
		<br>

			
		
	</table>


	<br>
			<br>

<center>
			<form method="post" action="adminhome.php">
				level<br>
				<input type="number" name="valor" required="" >
				<input type="submit" name="jogosconf" value="Jogos"> 

			</form>

			
</center>

<br>
<br>
<br>
		</body>
		</html>

<?php 
?>