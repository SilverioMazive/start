<?php

include "imagens/config.php";

// session_start();

if (isset($_POST['uploadImageBtn'])) {
    $uploadFolder = '../uploads/';
    $instid = $_SESSION['instid'];
    $dataSeca = new DateTime('now');
    $data = $dataSeca->format('Y-m-d H:i:s');



    foreach ($_FILES['imageFile']['tmp_name'] as $key => $image) {
        $imageTmpName = $_FILES['imageFile']['tmp_name'][$key];
        $imageName = $_FILES['imageFile']['name'][$key];
        $result = move_uploaded_file($imageTmpName,$uploadFolder.$imageName);

        // save to database
        $query = "INSERT INTO bird_multiple_images SET imgName='$imageName', instid='$instid', data='$data' " ;
        $run = $connection->query($query) or die("Error in saving image".$connection->error);
    }
    if ($result) {
        echo '<script>alert("Upload efectuado com sucesso!")</script>';
        echo '<script>window.location.href="../galeria.php";</script>';
    }
}