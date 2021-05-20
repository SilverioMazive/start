<?php
// //Esconde erros
// ini_set('display_errors', 0 );
// error_reporting(0);
?>
<?php


// include "../serio/view/connection.php";
    
    //Aqui puxei o resultado posetivo de download da url da vodacom
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    // if (isset($_GET['id'])) {
    //     $id = $_GET['id'];
        $sql = "select * from tblmpesarequest where id=".$id;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            //var_dump($row);
            
            unset($row['id']);
            echo(json_encode($row));

        }else {
            $errorMsg = 'Nenhum dado disponivel';
        }
    }    
    
    

?>