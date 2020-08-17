<?php
    header("Content-type: application/json; charset=utf-8");

    //decodificar la informacion (JSON) obtenida del cliente
    $informacion = json_decode(file_get_contents("php://input"), true);
    $nom = $informacion["_nombre"];
    $com = $informacion["_comentario"];
    
    //variables de conexion a la base de datos
    $host = "localhost";
    $db = "db_comentarios";
    $usuario = "root";
    $passwd = "";

    try {
        //Establecer conexion hacia la base de datos
        $con = new PDO('mysql:host=127.0.0.1;dbname=db_comentarios;charset=utf8','root','');
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //Preparar la sentencia SQL
        $stm=$con->prepare("INSERT INTO tbl_comentarios(c_nombre, c_comentario) VALUES(:nombre, :comentario)");

        $stm->execute(array(":nombre"=>$nom,":comentario"=>$com));

        //*****************************************
        //obtener los registros de la base de datos
        //preparar la sentencia SELECT de SQLSQL
        $stm=$con->prepare("SELECT * FROM tbl_comentarios");

        //Ejecutar sentencia de SQLSQL
        $stm->execute();

        //Declarar un arreglo que contendra los registros de la BDBD
        $registros=array();

        //Obtener informacion
        while($fila=$stm->fetch(PDO::FETCH_ASSOC)){
            $registros[]=$fila;
        }
        //cerrar conexion
        $con = null;
        $stp = null;

        echo json_encode($registros);

    } catch (PDOException $ex) {
        echo "Error: ".$ex->getMessage();
    }

    //enviando la respuesta en JSON
    //echo json_encode($informacion);
?>
