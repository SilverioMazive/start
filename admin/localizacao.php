<?php 
	require 'model/db.php';

	if(isset($_POST['aid'])) 
	{
		$dbgo = new Dbdbect;
		$db = $dbgo->dbect();

		if ($_POST['aid'] == "1") 
		{
			$tipolocal = 'Bairro';
		}
		else if ($_POST['aid'] == "2") 
		{
			$tipolocal = 'Mercado';
		}

		$stmt = $db->prepare("SELECT * FROM  tbbairro WHERE tipolocal = " . $tipolocal);
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($books);
	}

	function loadAuthors() 
	{
		$dbgo = new Dbdbect;
		$db = $dbgo->dbect();

		$stmt = $db->prepare("SELECT * FROM tbbairro");
		$stmt->execute();
		$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $authors;
	}

 ?>