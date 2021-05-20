<?php
//Esconde erros
// ini_set('display_errors', 0 );
// error_reporting(0);
?>
<?php
    // Lampirkan db dan User
    include "../prim/dbLogin.php";
    include "../prim/User.php";
    include "../prim/connection.php";

    //Buat object user
    $user = new User($db);

    //Jika sudah login
    if($user->isLoggedIn()){
        header("location: ../index.php"); //redirect ke index
    }

    //jika ada data yg dikirim


    $confsenha = 'indefinido';
    $sql = "SELECT * FROM tbinstituicoes where confsenha!='$confsenha' and email=".$_POST['email'];
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)){

        if(isset($_POST['kirim'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $lembrar = $_POST['lembrar'];
            
            // Proses login user
            if($user->login($email, $password, $lembrar)){
                header("location: ../index.php");
            }else{
                // Jika login gagal, ambil pesan error
                $error = $user->getLastError();
            }
        }
    }
    else
    {
        header("locaion: ../confirmacao.php");
    }
    
?>