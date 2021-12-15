<?php

function conectarBD(): mysqli{
    $db = mysqli_connect('localhost','root','root','bienes_raices');

   /*  if($db){
      echo "Conexion exitosa";
    }else{
        echo "No hay conexión";
    } */

    if(!$db){
        echo "No hay conexión";
        //exit;
    }

    return $db;
}