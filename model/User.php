<?php
    /**
     * Class User untuk melakukan login dan registrasi user baru
     */
    class User
    {

        private $db; //Menyimpan Koneksi database
        private $error; //Menyimpan Error Message

        // Contructor untuk class User, membutuhkan satu parameter yaitu koneksi ke databse
        function __construct($db_conn)
        {
            $this->db = $db_conn;

            // Mulai session
            session_start();
        }

        // Registrasi user baru
        public function registrocliente($nome, $categoria, $telefone, $password, $bairroid)
        {
            try
            {
                                
                $datar =  new DateTime('now');
                $datar->setTimezone(new DateTimeZone('Africa/Maputo'));
                $data = $datar->format('Y-m-d H:i:s');        
                $ganho = '0';
                $estado = 'permitido';
                $ip = 'Ainda por definir';
                // buat hash dari password yang dimasukkan
                $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

                //Masukkan user baru ke database


                
                // $query = $this->db->prepare("INSERT INTO tbusuarios(nome, telefone, ganho, data, ip, senha) 
                //     SELECT :nome, :telefone, :ganho, :data, :ip, :senha
                //     WHERE NOT EXISTS (SELECT * FROM tbbloqueados WHERE telefonenovo = :telefone)");
                $query = $this->db->prepare("INSERT INTO tbusuarios(nome, tipo, telefone, ganho, data, bairroid, senha, estado) VALUES(:nome, :tipo, :telefone, :ganho, :data, :bairroid, :senha, :estado)");
                $query->bindParam(":nome", $nome);
                $query->bindParam(":bairroid", $bairroid);
                $query->bindParam(":tipo", $categoria);
                $query->bindParam(":telefone", $telefone);
                $query->bindParam(":ganho", $ganho);
                $query->bindParam(":data", $data);
                $query->bindParam(":estado", $estado);
                $query->bindParam(":senha", $hashPasswd);
                $query->execute();

                return true;
                
                
            
            }catch(PDOException $e){
                // Jika terjadi error
                if($e->errorInfo[0] == 23000)
                {
                    //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                    //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                    $this->error = "O numero ja tem conta!";
                    return false;
                }else{
                    echo $e->getMessage();
                    return false;
                }


            }
        }

        //Login user
        public function login($telefone, $password)
        {
            try
            {
                // Ambil data dari database
                $query = $this->db->prepare("SELECT * FROM tbusuarios WHERE telefone = :telefone");
                $query->bindParam(":telefone", $telefone);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if($query->rowCount() > 0){

                    
                           
                    if(password_verify($password, $data['senha']))
                    {

                        return true;
                    
                    }else{
                        // $this->error = "Telefone / tipo ou Senha errada!";
                        return false;
                    }

                }else{
                    // $this->error = "O numero ou tipo nao tem conta!";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        // Registrasi user baru
        // public function recuperarpin($tipo, $password)
        // {
        //     try
        //     {
                                                
        //         $hashPasswd = password_hash($password, PASSWORD_DEFAULT);

        //         //Masukkan user baru ke database
        //         $query = $this->db->prepare("UPDATE tbusuarios SET senha=:senha WHERE telefone = :tipo or tipo = :tipo");
        //         $query->bindParam(":tipo", $tipo);
        //         $query->bindParam(":senha", $hashPasswd);
        //         $query->execute();

        //         //setcookie('telefonecliente',$telefone, (time() + (365 * 24 * 3600)));//1 ano

        //         if(isset($_SESSION['pacote']))
        //         {
        //             header("location: pagamento.php");
        //         }
        //         else
        //         {
        //             return true;
        //         }                
            
        //     }catch(PDOException $e){
        //         // Jika terjadi error
        //         if($e->errorInfo[0] == 23000)
        //         {
        //             //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
        //             //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
        //             $this->error = "Erro!";
        //             return false;
        //         }else{
        //             echo $e->getMessage();
        //             return false;
        //         }


        //     }
        // }

        // // Cek apakah user sudah login
        // public function isLoggedIn(){
        //     // Apakah user_session sudah ada di session
        //     if(isset($_COOKIE['telefonecliente']))
        //     {
        //         return true;
        //     }
        // }

        // // Ambil data user yang sudah login
        // public function getUser(){
        //     // Cek apakah sudah login
        //     if(!$this->isLoggedIn()){
        //         return false;
        //     }

        //     try {
        //         // Ambil data user dari database
        //         $query = $this->db->prepare("SELECT * FROM tbusuarios WHERE id = :id");
        //         $query->bindParam(":id", $_COOKIE['telefonecliente']);
        //         $query->execute();
        //         return $query->fetch();
        //     } catch (PDOException $e) {
        //         echo $e->getMessage();
        //         return false;
        //     }
        // }

        // // Logout user
        // public function logout(){
        //     setcookie('telefonecliente');           
        //     //unset($_SESSION['user_session']);
        //     return true;
        // }

        // Ambil error terakhir yg disimpan di variable error
        public function getLastError(){
            return $this->error;
        }
    }

?>
