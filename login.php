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

    //Jika sudah login
    if($user->isLoggedIn()){
        header("location: index.php"); //redirect ke index
    }

    //jika ada data yg dikirim
        
    
    if(isset($_POST['kirim'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $lembrar = $_POST['lembrar'];

        // Proses login user
        if($user->login($email, $password, $lembrar)){
            header("location: index.php");
        }else{
            $error = $user->getLastError();
        }
      }


?>
<!DOCTYPE html>
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>Login</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    <p><?php if (isset($error)): ?>
            <div style="color:red;">
                <hr>
                <?php echo $error ?>
                <hr>
            </div>
        <?php endif; ?></p>
                  </div>
                  <form class="user" method="POST" action="login.php">
                    <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                        placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" name="lembrar" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lembrar entrada</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="submit" name="kirim" class="btn btn-primary btn-block" value="Login">
                    </div>
                    <hr>
                  </form>
                  <hr>
                  
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
</body>

</html>