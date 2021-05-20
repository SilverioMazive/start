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
        
        //Login user
        public function login($email, $password, $lembrar)
        {
            try
            {
                // Ambil data dari database
                $query = $this->db->prepare("SELECT * FROM tbinstituicoes WHERE email = :email");
                $query->bindParam(":email", $email);
                $query->execute();
                $data = $query->fetch();

                // Jika jumlah baris > 0
                if($query->rowCount() > 0){
                    // jika password yang dimasukkan sesuai dengan yg ada di database
                    if(password_verify($password, $data['senha'])){

                        $_SESSION['instid'] = $data['instid'];
                        if($lembrar=='1' || $lembrar=='on')
                        {
                            setcookie('instid',$data['instid'], (time() + (30 * 24 * 3600)));//30 dias
                        }                        
                        return true;
                        
                    }else{
                        $this->error = "Email ou Senha errada!";
                        return false;
                    }
                }else{
                    $this->error = "Email ou Senha errada!";
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
        
        // Registrasi user baru
        public function updatesenha($instid, $password)
        {
            try
            {
                                                
                $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
                $confsenha = 'good';

                //Masukkan user baru ke database
                $query = $this->db->prepare("UPDATE tbinstituicoes SET senha=:senha, confsenha=:confsenha WHERE instid=:instid");
                $query->bindParam(":instid", $instid);
                $query->bindParam(":senha", $hashPasswd);
                $query->bindParam(":confsenha", $confsenha);
                $query->execute();
                
                // setcookie('instid',$email, (time() + (7 * 24 * 3600)));//1 ano

                return true;
                
            
            }catch(PDOException $e){
                // Jika terjadi error
                if($e->errorInfo[0] == 23000)
                {
                    //errorInfor[0] berisi informasi error tentang query sql yg baru dijalankan
                    //23000 adalah kode error ketika ada data yg sama pada kolom yg di set unique
                    $this->error = "Erro!";
                    return false;
                }else{
                    echo $e->getMessage();
                    return false;
                }


            }
        }

        // Cek apakah user sudah login
        public function isLoggedIn(){
            // Apakah user_session sudah ada di session
            if(isset($_SESSION['instid']))
            {
                return true;
            }
        }

        // Ambil data user yang sudah login
        public function getUser(){
            // Cek apakah sudah login
            if(!$this->isLoggedIn()){
                return false;
            }

            try {
                // Ambil data user dari database
                $query = $this->db->prepare("SELECT * FROM tbinstituicoes WHERE instid = :instid");
                $query->bindParam(":instid", $_COOKIE['instid']);
                $query->execute();
                return $query->fetch();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        // Logout user
        public function logout(){
            setcookie('instid');        
            unset($_SESSION['instid']);
            //unset($_SESSION['user_session']);
            return true;
        }

        // Ambil error terakhir yg disimpan di variable error
        public function getLastError(){
            return $this->error;
        }
    }

?>
