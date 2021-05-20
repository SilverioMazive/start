<?php
//Esconde erros
// ini_set('display_errors', 0 );
// error_reporting(0);
?>
<?php
    // Lampirkan db dan User
    include "model/dbLogin.php";
    include "model/User.php";
    include "model/connection.php";
  
    //Buat object user
    $user = new User($db);
        
    if(isset($_GET['tlcliente']) && isset($_GET['tlcliente']))
    {
      $telefone = htmlentities(mysqli_real_escape_string($conn , $_GET['tlcliente']));
      $password = htmlentities(mysqli_real_escape_string($conn , $_GET['password']));
      
      // Proses login user
      if($user->login($telefone, $password))
      {
        $arr = array('loginsucess' => 1, 'resposta' => 'Login efectuado com sucesso!');
        echo json_encode($arr);
      }else{
        $arr = array('loginerror' => 1, 'resposta' => 'Login nao realizado com sucesso!');
        echo json_encode($arr);
      }
    }
    else
    {
      //DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
      $arr = array('noncliente' => 1, 'resposta' => 'Sem dados completos para continuar o registro');
      echo json_encode($arr);
    }

?>
