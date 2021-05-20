<?php
//Esconde erros
ini_set('display_errors', 0 );
error_reporting(0);
?>
<?php
    // Konfigurasi database anda
    $host = "localhost";
    $dbname = "bet";
    $username = "root";
    $password = "";

    try {
        // Buat Object PDO baru dan simpan ke variable $db
        $db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
        // Mengatur Error Mode di PDO untuk segera menampilkan exception ketika ada kesalahan
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }
?>
