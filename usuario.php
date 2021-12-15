<?php 
//importar la conexión

require 'includes/config/database.php';
$db = conectarBD();

//Crear un email y contraeña 

$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT); //TODO LOS PASSWORD CONS HASH VAN SER DE 60 CARACTERES

//Query para crear el usuario

$query = " INSERT INTO usuarios (email,password) VALUES ('${email}', '${passwordHash}')";

//Agregarlos a la base de datos 

echo $query;

mysqli_query($db, $query);

