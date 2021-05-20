<?php  

  include "model/dbLogin.php";
  include "model/User.php";
  include "model/connection.php";
  include "controller/permissao.php";

  $user = new User($db);
 
if(isset($_POST['submit'])) 
{
     if(isset($_POST['tlcliente']) && isset($_POST['nome']) && isset($_POST['categoria']) && isset($_POST['reppassword']) && isset($_POST['password']) && isset($_POST['bairroid']))
    {
      $nome = htmlentities(mysqli_real_escape_string($conn , $_POST['nome']));
      $categoria = htmlentities(mysqli_real_escape_string($conn , $_POST['categoria']));
      $telefone = (int)str_replace(' ', '', intval($_POST['tlcliente']));
      $password = htmlentities(mysqli_real_escape_string($conn , $_POST['password']));
      $reppassword = htmlentities(mysqli_real_escape_string($conn , $_POST['password']));
      $bairroid = (int)str_replace(' ', '', intval($_POST['bairroid']));

      if($_POST['password'] != $_POST['reppassword'])
      {
        $error = 'Os campos de password contem codigos diferrentes!';
      }
      else
      {
        if ($tipo == "admin" && $categoria == "admin") 
        {
          setcookie('info', "<b style='color: red;'>Infelizmente não pode adicionar gestores de mercado.</b>", (time() + 5));
          header("location: usuarios.php");
        }
        else
        {
          if($user->registrocliente($nome, $categoria, $telefone, $password, $bairroid))
          {
            setcookie('info', "<b style='color: blue;'>Usuario inserido com sucesso</b>", (time() + 5));
            header("location: usuarios.php");
          }
          else
          {
            $error = 'Registro nao realizado com sucesso!';
          }
        }
      }
    }
    else
    {
      //DEVOLVER RESPOSTA DE QUE NAO TEM CLIENTE COM ESSE NUMERO E PEDIR REGISTRO
      $error = 'Sem dados completos para continuar o registro';
    }

}


?>

<div class="row" style="margin-left: 20px;">
  <div class="col-lg-6">
    <!-- Form Basic -->
    <div class="card mb-4">
      <div class="">
        <center style="margin-top: 15px;">
          <h4  class="m-0 font-weight-bold text-primary">Adicionar Usuario</h4>
        </center>
      </div>

      <div class="card-body">
        <form method="post" enctype="multipart/form-data" action="userinsert.php">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Categoria</label>
             <select name="categoria" class="form-control" id="category">
              <option value="0">-- Selecione a categoria --</option>
              <option value="cliente">-- Cliente --</option>
              <option value="vendedor">-- Vendedor --</option>
              <option value="entregador">-- Entregador --</option>
              <option value="distribuidor">-- Distribuidor --</option>
              <option value="admin">-- Gestor do Mercado --</option>
            </select>
          </div>
          <br>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Localização</label>
             <select name="bairroid" class="form-control" id="category">
              <option value="0">-- Pode ser Mercado ou Distrito Municipal --</option>
              <option value="1">-- Liberdade --</option>
              <option value="2">-- Machava --</option>
              <option value="3">-- Matola --</option>
              <option value="4">-- Ferroviario --</option>
            </select>
          </div>
          <br>
          <div class="form-group">
            <label for="exampleInputEmail1">Nome Completo</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="nome" aria-describedby="emailHelp"
              placeholder="Nome Completo">                
          </div>  
          <br>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Telefone</label>
               <input type="number" pattern="[0-9]" class="form-control" name="tlcliente" placeholder="Introduza o numero de telefone" value="">
          </div>
          <br>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password">
          </div>
          <br>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Repetir Password</label>
            <input type="password" class="form-control" id="exampleInputPassword" name="reppassword" placeholder="Repetir Password">
          </div>
          <br>
          <center>
            <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Adicionar">
          </center>
          <br>
        </form>
      </div>
    </div>

  </div>
</div>