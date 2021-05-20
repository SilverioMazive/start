<?php
//Esconde erros
// ini_set('display_errors', 0 );
// error_reporting(0);
?>
<?php

    include "model/dbLogin.php";
    include "model/User.php";
    include "model/connection.php";

    $user = new User($db);
   
    if(isset($_GET['tlcliente']) && isset($_GET['nome']) && isset($_GET['password']) && isset($_GET['bairroid']) && isset($_GET['reppassword']))
    {
      $nome = $_GET['nome'];
      $categoria = 'cliente';
      $telefone = $_GET['tlcliente'];
      $password = $_GET['password'];
      $bairroid = $_GET['bairroid'];

      if($_GET['password'] != $_GET['reppassword'])
      {
        $arr = array('senhasdiferrentes' => 1, 'resposta' => 'Os campos de password contem codigos diferrentes!');
        echo json_encode($arr);
      }
      else
      {
        if($user->registrocliente($nome, $categoria, $telefone, $password, $bairroid))
        //if($user->registrocliente('fsdf5', 'cliente', '445457545', '11111', '2'))
        {
          //header("location: index.php");
          //CERTIFICAR QUE FOI REGISTRADO O CLIENTE COM SUCESSO
          $arr = array('registrosucess' => 1, 'resposta' => 'Registro efectuado com sucesso!');
          echo json_encode($arr);
        }
        else
        {
          $arr = array('registroerror' => 1, 'resposta' => 'Registro nao realizado com sucesso!');
          echo json_encode($arr);
        }
      }
    }
    else
    {
      //DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
      $arr = array('noncliente' => 1, 'resposta' => 'Sem dados completos para continuar o registro');
      echo json_encode($arr);
    }

?>


