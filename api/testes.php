<?php


	$description = "Pra ser sincero vamos sambar ate"  ;



if(strlen($description) > 10 )
{
     echo substr($description,0,strpos($description,' ',10));             //strpos to find ‘ ‘ after 30 characters.
}
else {
     echo $description;
}




	// $telefone = "Nao sabia amar asdfsa";
	// $newtelefone = substr($telefone, 0, -3);

	// $tamanho = strlen($telefone);

	// if($tamanho < 20)
	// {
	// 	$rest = substr("abcdef", -3, 1);
	// }

	// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

	// echo json_encode($arr);
?>