<?php
    header("Content-type: application/json; charset=utf-8");
    
    //decodificar la informacion (JSON) obtenida del cliente
    $informacion = json_decode(file_get_contents("php://input"), true);
    
    //enviando la respuesta en JSON
    echo json_encode($informacion);
?>
