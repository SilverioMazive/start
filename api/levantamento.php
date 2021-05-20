<?php

include "connection.php";
include "variaveis.php";

if(isset($_GET['tlcliente']))
{

    $telefonelevantamento = '258'.$_GET['tlcliente'];  
    $telefonecliente = $_GET['tlcliente'];  
    //$telefonelevantamento = '258'.$telefone;   
    $valorLevant = $_GET['valor'];          
    $nome = 'HakelaBetLevantar';
    $dataSeca = new DateTime('now');
    $dataSeca->setTimezone(new DateTimeZone('Africa/Maputo'));
    $datalev = $dataSeca->format('Y-m-d H:i:s');       

    //ADICIONAR ESTE TESTO AGORA ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    if (preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $valorLevant) || preg_match( '/^[\-+]?[0-9]*\.*\,?[0-9]+$/', $telefonelevantamento) ) 
    {
        
    }
    else {
      header("location: index.php");
    }

    $sql2 = "SELECT * FROM tbusuarios WHERE telefone=".$telefonecliente;
    $result2 = mysqli_query($conn, $sql2);
    if(mysqli_num_rows($result2))
    {
      while($row2 = mysqli_fetch_assoc($result2))
      {
        $uid = $row2['uid'];        
        $ValorDisponivel = $row2['ganho'];        
      }
    }  


    // $arr = array('UsuarioId' => $uid, 'ValorDisponivel' => $ValorDisponivel);
    // echo json_encode($arr);

    if($valorLevant <= $ValorDisponivel)
    {
      
      $url = $urlpayment.'api/c2b.php';
      $idPost = '1';
      $data = array('id' => $idPost);
      // $url = 'https://cs.musicambicano.com/hakelaapp/c2b.php';
      //$data = array('phone_number' => $telefonelevantamento,'amount' => $valorLevant, 'nome' => $nome, 'valordisponivel' => $ValorDisponivel);
      $options = array(
          'http' => array(
              'header' => "Content-type: application/x-www-form-urlencoded\r\n",
              'method' => 'POST',
              'content' => http_build_query($data)
          )
      );
      $context = stream_context_create($options);
      $resposta = file_get_contents($url, false, $context);
      if($resposta === FALSE) {echo ('Errado!');}
      

      //AQUI FILTRAR COM IF PARA DEPOIS PROCESSAR O PAGAMENTO    
      $obj = json_decode($resposta);
      $respostaDoMpesa = $obj->{'output_ResponseCode'};


      if($respostaDoMpesa == 'INS-0')
      {
      
        $sqlInsert = "INSERT INTO tblevantamento(telefone, valor, data)
            values('".$telefonecliente."', '".$valorLevant."', '".$datalev."')";
            $resultInsert = mysqli_query($conn, $sqlInsert);
        
        $sqlNosso = "UPDATE `tbusuarios` SET `ganho`=`ganho`-'$valorLevant' WHERE `uid`='$uid'";
        $resultNosso = mysqli_query($conn, $sqlNosso);        

        $levantamento = 'Levantamento efectuado com sucesso, o valor sera enviado para a conta do MPesa do contacto '.$telefonecliente;

        $arr = array('levantamento' => 1, 'resposta' => $levantamento);
        echo json_encode($arr);                

      }
      else
      {
        $error = $respostaDoMpesa;
      }
    }
    else
    {
      $error = 'Não tens saldo suficiente para efectuar esse levantamento';
      $arr = array('semsaldosuficiente' => 1, 'resposta' => $error);
        echo json_encode($arr);
    }
  
}

?>