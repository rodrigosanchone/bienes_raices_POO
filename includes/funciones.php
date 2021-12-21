<?php

//require 'app.php'; ya no es necesario en POO, pues causaria un loop



define('TEMPLATES_URL', __DIR__.'/templates'); // muevo estas constantes de app.php a funciones.php
define('FUNCIONES_URL',__DIR__.'funciones.php');

function incluirTemplate(string $nombre, bool $inicio = false){
    include TEMPLATES_URL ."/${nombre}.php";
}

function estaAutenticado(): bool{
        session_start();
        

     

        if(!$_SESSION['login']){
            header('Location /');
           
        }

        return false;
}

function debuguear($variable){
        echo "<pre>";
        var_dump($variable);
        echo  "</pre>";   
}