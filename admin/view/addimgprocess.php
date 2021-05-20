<?php

include "connection.php";
include "_mozamor_%.php";

$upload_dir = '../../uploads/';

if(isset($_POST['submit'])) {

    
    $img =htmlentities(mysqli_real_escape_string($conn , $_POST['imglink']));
	$question =htmlentities(mysqli_real_escape_string($conn , $_POST['question']));
	$choice1 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice1']));
	$choice2 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice2']));
	$choice3 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice3']));
	$choice4 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice4']));
	$choice5 = htmlentities(mysqli_real_escape_string($conn , $_POST['choice5']));
	$level = htmlentities(mysqli_real_escape_string($conn , $_POST['level']));
	$correct_answer = mysqli_real_escape_string($conn , $_POST['answer']);
	$acertos = '0';
	$dataSeca = new DateTime('now');
	$data = $dataSeca->format('Y-m-d H:i:s');  


    // $checkqsn = "SELECT * FROM questions";
	// $runcheck = mysqli_query($conn , $checkqsn) or die(mysqli_error($conn));
    // $qno = mysqli_num_rows($runcheck) + 1;
    
    if(!isset($errorMsg)){

        $query = "INSERT INTO tbjogoimagens (question, img, ans1, ans2, ans3, ans4, ans5, correct_answer, level, acertos, data) VALUES ('$question' ,'$img' , '$choice1' , '$choice2' , '$choice3' , '$choice4' ,'$choice5' , '$correct_answer','$level','$acertos','$data') " ;
        $run = mysqli_query($conn , $query) or die(mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            echo '<script>setTimeout(function(){ window.location = "http://localhost:8090/bet/serio/view/addimg.php"; },500); </script> ' ;
            //echo "<script>alert('Inserido com sucesso!'); </script> " ;
            //header('refresh: 10; url=login.php');//Faz o redirecionamento em PHP
            //header('location: url=addimg.php');
        }
        else {
            "<script>alert('error, try again!'); </script> " ;
        }
       
    }

}

?>