<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
if (isset($_SESSION['admin'])) {
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

		
	<h1> Todas nomes</h1>
	<table class="data-table">
		<caption class="title">
		
		<form action="allnomes.php" method="POST">
			<center><h3></h3></center>
			<center>
				<table>
					<tr>
						<td>Procurar</td>
						<td><input type="text" name="name" size="50"></td>
						<td><input type="submit" name="Procurar"></td>
					</tr>
				</table>
			</center>
		</form>

		</caption>
		<thead>
			<tr>
				<th>ID</th>
				<th>telefone</th>
				<th>valor</th>
				<th>resultado</th>
				<th>Data</th>
				
			</tr>
		</thead>
		<tbody>
        
        <?php 
			
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$query = "SELECT * FROM tbpalavrasresult WHERE telefone LIKE '%$name%'";
			}
			else
			{
				$query = "SELECT * FROM tbpalavrasresult WHERE resultado='vencedor' ORDER BY presultid DESC limit 200";
			}			
           
            $select_nomes = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_nomes) > 0 ) {
            while ($row = mysqli_fetch_array($select_nomes)) {
                $presultid  = $row['presultid'];
                $telefone = $row['telefone'];
                $valor = $row['valor'];
                $resultado = $row['resultado'];
                $option4 = $row['data'];
                echo "<tr>";
                echo "<td>$presultid</td>";
                echo "<td>$telefone</td>";
                echo "<td>$valor</td>";
                echo "<td>$resultado</td>";
                echo "<td>$option4</td>";
                             
                echo "</tr>";
             }
         }
        ?>
	
		</tbody>
		
	</table>
</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>


