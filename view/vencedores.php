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
				<th>Nome</th>
				<th>telefone</th>
				<th>valor</th>
				<th>estado</th>
				<th>Data</th>
				
			</tr>
		</thead>
		<tbody>
        
        <?php 
			
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$query = "SELECT * FROM tbvencedores WHERE nome LIKE '%$name%' or telefone LIKE '%$name%'";
			}
			else
			{
				$query = "SELECT * FROM tbvencedores ORDER BY vencedorid DESC limit 200";
			}			
           
            $select_nomes = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_nomes) > 0 ) {
            while ($row = mysqli_fetch_array($select_nomes)) {
                $nomeid  = $row['nomeid'];
                $nome = $row['nome'];
                $telefone = $row['telefone'];
                $valor = $row['valor'];
                $estado = $row['estado'];
                $option4 = $row['data'];
                echo "<tr>";
                echo "<td>$nomeid</td>";
                echo "<td>$nome</td>";
                echo "<td>$telefone</td>";
                echo "<td>$valor</td>";
                echo "<td>$estado</td>";
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


