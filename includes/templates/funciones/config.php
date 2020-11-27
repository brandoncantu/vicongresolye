<?php             
    $user = 'root';
    $password = '';
    $db = 'vicongreso';
    $host = '127.0.0.1';

    $link = mysqli_connect($host, $user, $password, $db);
        if(!$link){
            die("Connection failed: " . mysqli_connect_error());
        }else{
            //echo "Connection succesfull!";
        }
        //$all = " SELECT * FROM eventos ";
        //$list = $link-> query($all);
    ?>