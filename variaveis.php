<?php  

    $datar =  new DateTime('now');
    $datar->setTimezone(new DateTimeZone('Africa/Maputo'));//Deve ser a data do brasil
    $datanow = $datar->format('Y-m-d H:i:s');

    $upload_dir = 'https://cs.musicambicano.com/dreamseeder/uploads/';

    

?>