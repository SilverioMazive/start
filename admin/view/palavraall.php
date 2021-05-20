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

		
	<h1> Todas Palavras</h1>
	<table class="data-table">
		<caption class="title">
		
		<form action="allpalavras.php" method="POST">
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
				<th>Palavra</th>
				<th>Acertos</th>
				<th>Erros</th>
				<th>Level</th>
				<th>Data</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
        
        <?php 
			
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$query = "SELECT * FROM tbpalavras WHERE palavra LIKE '%$name%' or level LIKE '%$name%'";
			}
			else
			{
				$query = "SELECT * FROM tbpalavras ORDER BY palavraid DESC limit 100";
			}			
           
            $select_palavras = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_palavras) > 0 ) {
            while ($row = mysqli_fetch_array($select_palavras)) {
                $palavraid  = $row['palavraid'];
                $palavra = $row['palavra'];
                $option1 = $row['acertos'];
                $option2 = $row['erros'];
                $option3 = $row['level'];
                $option4 = $row['data'];
                echo "<tr>";
                echo "<td>$palavraid</td>";
                echo "<td>$palavra</td>";
                echo "<td>$option1</td>";
                echo "<td>$option2</td>";
                echo "<td>$option3</td>";
                echo "<td>$option4</td>";
                echo "<td> <a href='palavraedit.php?palavraid=$palavraid'> Edit </a></td>";
              
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


