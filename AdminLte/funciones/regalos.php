<?php
if($_POST['data']=='regalos'){
    $user = 'b14fa1a2e46d45';
    $password = '116b8057';
    $db = 'heroku_15cf40b5956ac06';
    $host = 'us-cdbr-east-02.cleardb.com';

    $link = mysqli_connect($host, $user, $password, $db);
    $cantidad = array();
    $regalo = array();
    for($i= 1; $i<=3; $i++){
        $sql = "SELECT COUNT(*) as res, regalo.regalo from registrados
        INNER join regalo
        on registrados.regalo = regalo.id_regalo
        where registrados.regalo = {$i}";
        $resultado = $link->query($sql);
        $cant = $resultado->fetch_assoc();
        $cantidad[$i] = $cant['res'];
        $regalo [$i] = $cant['regalo'];
    }

    $resultado = array(
        'cant' => $cantidad,
        'regalo' => $regalo
    );

        $link->close();
        die(json_encode($resultado));
}

?>