<?php
function Eventos($fecha){
    $user = 'b14fa1a2e46d45';
    $password = '116b8057';
    $db = 'heroku_15cf40b5956ac06';
    $host = 'us-cdbr-east-02.cleardb.com';
    
    $link = mysqli_connect($host, $user, $password, $db);
        $sql = "CALL `getEventos`('$fecha')";
        $resultado = $link->query($sql);
        $dia = array();
        $categoria = array();
        while($eventos = $resultado->fetch_assoc()){

            $d = $eventos['fecha_evento'];
            $tipo = $eventos['cat_evento'];
            $evt = array(
                'cat' => $eventos['cat_evento'],
                'nombre' => $eventos['nombre_evento'],
                'hora' => $eventos['hora_evento'],
                'clave' => $eventos['clave'],
            );
            $categoria[$tipo][] = $evt;
            $dia[$d] = $categoria;                    
        }
        foreach($categoria as $cat){

            echo '<div>';
            echo "<p>". $cat[0]['cat']. "</p>";

            foreach($cat as $data){
                echo '<label><input type="checkbox" name="registro[]" id="';
                echo $data['clave'];
                echo '"value="';
                echo $data['clave'];
                echo '"><time> ';
                echo $data['hora'];
                echo '</time> ';
                echo $data['nombre'];
                echo '</label><br>';
            }                               
            echo '</div>';                         
        }
        $link->close();
}

function dashBoardInfo($input){
    
    $user = 'b14fa1a2e46d45';
    $password = '116b8057';
    $db = 'heroku_15cf40b5956ac06';
    $host = 'us-cdbr-east-02.cleardb.com';

    $link = mysqli_connect($host, $user, $password, $db);
    if($input == "all"){
        $sql = 'SELECT COUNT(*) as "res" FROM registrados';
    }
    if($input == "pagado"){
        $sql = 'SELECT COUNT(*) as "res" from registrados where pagado = 1';
    }
    if($input == "nopagado"){
        $sql = 'SELECT COUNT(*) as "res" from registrados where pagado = 0';
    }
    if($input == "total"){
        $sql = 'SELECT ROUND(SUM(total_pagado),2) as "res" from registrados where pagado = 1';
    }
    if($input == "stickers"){
        $sql = "SELECT * FROM registrados";
        $res = $link->query($sql);
        $total = 0;
        while($registrado = $res->fetch_assoc()){
            $articulos = json_decode($registrado['pases_articulos']);
            $arreglo_articulos = array(
                '1dia' => 'Pase 1 dia',
                '2dias' => 'Pase 2 dias',
                '3dias' => 'Pase completo',
                'camisas' => 'Camisas',
                'etiquetas' => 'Stickers'
            );
            
            foreach($articulos as $llave => $articulo){
                if($arreglo_articulos[$llave] == "Stickers"){
                    $total = $total + $articulo;
                }
            };
        }
        $link->close();
        return $total;
    }
    if($input == "camisas"){
        $sql = "SELECT * FROM registrados";
        $res = $link->query($sql);
        $total = 0;
        while($registrado = $res->fetch_assoc()){
            $articulos = json_decode($registrado['pases_articulos']);
            $arreglo_articulos = array(
                '1dia' => 'Pase 1 dia',
                '2dias' => 'Pase 2 dias',
                '3dias' => 'Pase completo',
                'camisas' => 'Camisas',
                'etiquetas' => 'Stickers'
            );
            
            foreach($articulos as $llave => $articulo){
                if($arreglo_articulos[$llave] == "Camisas"){
                    $total = $total + $articulo;
                }
            };
        }
        $link->close();
        return $total;
    }
        $resultado = $link->query($sql);
        $cant = $resultado->fetch_assoc();
        $cantidad = $cant['res'];


        $link->close();
        return $cantidad;
}
?>