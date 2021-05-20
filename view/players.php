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

		
	<h1> Todos Clientes</h1>
	<table class="data-table">
		<caption class="title">
		<form action="players.php" method="POST">
<center><h3></h3></center>
<center><table>
<tr>
	<td>Procurar</td>
	<td><input type="text" name="name" size="50"></td>
	<td><input type="submit" name="Procurar"></td>
</tr>
</table></center>
</form>
		</caption>
		<thead>
			<tr>
			<th>Id</th>
			<th>Nome</th>
			<th>Telefone</th>
			<th>Saldo</th>
			<th>Data</th>
			<th>Info</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$query = "SELECT * FROM tbusuario WHERE nome LIKE '%$name%' or telefone LIKE '%$name%'";
			}
			else
			{
				$query = "SELECT * FROM tbusuario ORDER BY id DESC LIMIT 30";
			}
			$select_players = mysqli_query($conn, $query) or die(mysqli_error($conn));
			if (mysqli_num_rows($select_players) > 0 ) {
				while ($row = mysqli_fetch_array($select_players)) {
					$id = $row['id'];
					$nome = $row['nome'];
					$telefone = $row['telefone'];
					$saldo = $row['saldo'];
					$data = $row['data'];
					echo "<tr>";
					echo "<td>$id</td>";
					echo "<td>$nome</td>";
					echo "<td>$telefone</td>";
					echo "<td>$saldo</td>";
					echo "<td>$data</td>";
					echo "<td><a href='cliente.php?telefone=$telefone'>Ver</a></td>";
				
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

