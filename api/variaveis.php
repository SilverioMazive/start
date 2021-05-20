<?php  

    $datar =  new DateTime('now');
    $datar->setTimezone(new DateTimeZone('Africa/Maputo'));//Deve ser a data do brasil
    $datanow = $datar->format('Y-m-d H:i:s');

    $urlpayment = "http://localhost:8090/dreamseeder/";
    $upload_dir = $urlpayment.'uploads/';

    if (isset($_GET['tlcliente']))
    {
    	$tlcliente = $_GET['tlcliente'];
        $sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$tlcliente'";
        $resultno1 = mysqli_query($conn, $sqlno1);
        if (mysqli_num_rows($resultno1) > 0) 
        {
            $rowno1 = mysqli_fetch_assoc($resultno1);
            $uidcliente = $rowno1['uid'];
        }
    }

    if (isset($_GET['tlvendedor'])) 
    {
    	$tlvendedor = $_GET['tlvendedor'];
        $sqlno1 = "SELECT * FROM tbusuarios WHERE telefone='$tlvendedor'";
        $resultno1 = mysqli_query($conn, $sqlno1);
        if (mysqli_num_rows($resultno1) > 0) 
        {
            $rowno1 = mysqli_fetch_assoc($resultno1);
            $uidvendedor = $rowno1['uid'];
        }
    }

?>