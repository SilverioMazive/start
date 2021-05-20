<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
if (isset($_SESSION['admin'])) {

 
	
}
else {
	header("location: admin.php");
}
?>


<?php 
if (isset($_GET['palavraid'])) {
	$palavraid = mysqli_real_escape_string($conn , $_GET['palavraid']);
	if (is_numeric($palavraid)) {
		$query = "SELECT * FROM tbpalavras WHERE palavraid = '$palavraid' ";
		$run = mysqli_query($conn, $query) or die(mysqli_error($conn));
		if (mysqli_num_rows($run) > 0) {
			while ($row = mysqli_fetch_array($run)) {
				 $palavraid = $row['palavraid'];
                 $palavra = $row['palavra'];
                 $level = $row['level'];
			}
		}
		else {
			echo "<script> alert('error');
			window.location.href = 'palavraall.php'; </script>" ;
		}
	}
	else {
		header("location: palavraall.php");
	}
}


?>

<?php




if (isset($_SESSION['admin'])) {

    if(isset($_POST['submit']) && $_POST['level'] != "none") {

        $palavra =htmlentities(mysqli_real_escape_string($conn , strtoupper($_POST['palavra'])));
        $level = (int)str_replace(' ', '', intval($_POST['level']));
        $acertos = '0';
        $erros = '0';
                

        $dataSeca = new DateTime('now');
        $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
        $data = $dataSeca->format('Y-m-d H:i');  
            
        $query = "UPDATE tbpalavras SET palavra = '$palavra' , level = '$level' WHERE palavraid = '$palavraid' ";
		$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
		if (mysqli_affected_rows($conn) > 0 ) {
            // echo "<script>alert('Inserido com sucesso!'); </script> " ;
            $inserida = 'Atualizada com sucesso!';
        }
        else {
            "<script>alert('Erro, tente novamente!');</script>";
        }
    }
    else
    {
    	"<script>alert('Selecione um nivel!');</script>";
    }
}
 

?>


<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style type="text/css">
			
.myButton {
	box-shadow: 0px 10px 14px -7px #3e7327;
	background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
	background-color:#77b55a;
	border-radius:4px;
	border:1px solid #4b8f29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
	padding:6px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #5b8a3c;
}
.myButton:hover {
	background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
	background-color:#72b352;
}
.myButton:active {
	position:relative;
	top:1px;
}
		</style>
	</head>

	<body>
	<?php
			include "header.php";
		?>

		<main>
			<div class="container">
				<h2>Adicionar Palavra</h2>
				<form method="post" enctype="multipart/form-data" action="">

					<p>
						<label>Palavra</label>
						<input type="text" name="palavra" required="" value="<?php echo($palavra); ?>">
					</p>
					<p>
						<label>Level</label>
						<select name="level">
							<option value="<?php echo($level); ?>"><?php echo("#".$level); ?></option>
							<option value="0"> #0</option>
	                        <option value="1"> #1 </option>
	                        <option value="2"> #2</option>
	                        <option value="3"> #3</option>
	                        <option value="4"> #4</option>
	                    </select>
					</p>
					
					<p>						
						<input type="submit" name="submit" value="Submit">
					</p>
				</form>	
				<br>
				<a href="palavraall.php" class="myButton">Todas Palavra</a>
				<br>

			</div>
		</main>

		<h2>
			<?php 
				if (isset($inserida))
				{
					print($inserida); 
				}				
			?>			
		</h2>

	</body>
</html>
