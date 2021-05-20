<?php session_start(); ?>
<?php include "connection.php";
include "_mozamor_%.php";
include "adminhomeprocess.php";
if (isset($_SESSION['admin'])) {

    $telefone = $_GET['telefone'];

    $sql = "SELECT * FROM tbusuario
        WHERE  telefone='$telefone'";
    $result = mysqli_query($conn, $sql);
    $row  = mysqli_fetch_assoc($result);
    $saldo = $row['saldo'];
    $nome = $row['nome'];
   

if(isset($_POST['submit'])) {
	$telefone =$_SESSEION['telefone'];
    $valor = htmlentities(mysqli_real_escape_string($conn , $_POST['valor']));
    $meid = '1';
	$dataSeca = new DateTime('now');
	$data = $dataSeca->format('Y-m-d H:i');  
    $telefone = $_GET['telefone'];


    //ADICIONAR ESTE TESTO AGORA ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    if (preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $valor) || preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $telefone) ) {
            
    }
    else {
        header("location: index.php");
    }

    if($_POST['senha'] == 'playsilver0815')
    {
        $sqlInsert = "INSERT INTO tbdevolucoes(telefone, valor, data)
            VALUES ('$telefone', '$valor', '$data') " ;
            $resultInsert = mysqli_query($conn, $sqlInsert);
        
        $sqlNosso = "Update tbme set ganho=ganho-'".$valor."' 
            where meid=".$meid;
            $resultNosso = mysqli_query($conn, $sqlNosso);       

        $sqlNosso = "Update tbusuario set saldo=saldo+'".$valor."' 
            where telefone=".$telefone;
            $resultNosso = mysqli_query($conn, $sqlNosso);        

        header("location: cliente.php?telefone=".$telefone);                  
    }
        
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>PHP-Kuiz</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<?php
			include "header.php";
		?>

		<main>
            <div class="container">
                <h2><?php print($nome.' - '.$telefone.' - '.$saldo.' Mt') ?></h2>
                <form method="post" enctype="multipart/form-data" action="">
                    <p>
                        <label>Valor</label>
                        <input type="text" name="valor" required="">
                    </p>
                    <p>
                        <label>Senha</label>
                        <input type="password" name="senha" required="">
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Devolver">
                    </p>
                </form>
            </div>
        </main>

		

	</body>
</html>

<?php } 
else {
	header("location: admin.php");
}
?>