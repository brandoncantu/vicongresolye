<?php

function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
    $dias = array(0 => '1dia', 1 => '3dias', 2 => '2dias');
    $total_boletos = array_combine($dias, $boletos);
    $json = array();

    foreach($total_boletos as $key => $boletos){
        if((int) $boletos > 0 || $boletos != ""){
            $json[$key] = (int) $boletos;
        }
    }
    
    if((int) $camisas > 0 || $camisas != ""){
        $json['camisas'] = (int) $camisas;
    }
    if((int) $etiquetas > 0 || $etiquetas != ""){
        $json['etiquetas'] = (int) $etiquetas;
    }

    return json_encode($json);
}

function eventos_json(&$eventos){
    $json = array();

    foreach($eventos as $evt){
        $json['eventos'][] = $evt;
    }


    return json_encode($json);
}

function getEventos($fecha){
    require 'config.php';
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
                echo '"><time>';
                echo $data['hora'];
                echo '</time> ';
                echo $data['nombre'];
                echo '</label>';
            }                               
            echo '</div>';                         
        }
        $link->close();
}