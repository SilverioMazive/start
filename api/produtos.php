<?php  

	include "connection.php";
	include "variaveis.php";

	if (isset($_GET['prodtipo'])) 
	{
		$prodtipo = $_GET['prodtipo'];//1 para clientes e 2 para vendedores

		$sqlJ = "SELECT * tbprod.prodid, tbprod.nome, tbprod.preco, tbprod.descricao, tbprod.estado, tbquantificadores.quantificador, tbcategorias.nomecat as categoria
		FROM (tbprod left join tbquantificadores on tbquantificadores.quantificadorid=tbprod.quantificadorid) left join tbcategorias on tbcategorias.categoriaid=tbprod.categoriaid 
		where tbprod.estado='valido' and tbprod.prodtipo='$prodtipo' and tbprod.datavalidade > '$datanow' and tbprod.quantidade > '0'";
		$resultJ = mysqli_query($conn, $sqlJ);
		if(mysqli_num_rows($resultJ)){
		    foreach ($resultJ as $key => $fornecedorNome) 
		    {
				$json[] = $fornecedorNome;
			}
			print_r(json_encode($json));
		}
		else
		{
		    //SEM DADOS
			$arr = array('prodlist' => 1, 'resposta' => 'Nenhuma informação encontrada!');
			echo json_encode($arr);
		}
	}

	
	
?>