<?php

//conexión base de datos

//require 'includes/config/database.php';
//require 'includes/funciones.php';
require 'includes/app.php';
$db = conectarBD();

//Autenticar el usuario 

$errores=[];

if($_SERVER['REQUEST_METHOD']==='POST'){
   // var_dump($_POST);
   $email = mysqli_real_escape_string($db, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));
   // Var_dump($email);
   $password= mysqli_real_escape_string($db,  $_POST['password']);

   if(!$email){
       $errores[]="El email es requerido"; 
   }

   if(!$password){
       $errores[]="El password es requerido";
   }

   if(empty($errores)){
        //Revisar si el usuario existe

        $query = "SELECT *FROM usuarios WHERE email = '${email}' ";
        $resultado = mysqli_query($db,$query);
        //var_dump($query);
        //var_dump($resultado);

        if($resultado->num_rows){
            //Revisar si el password es correcto
                    $usuario = mysqli_fetch_assoc($resultado);// revisa los usuarios 
                    // var_dump($usuario);

                    //verificar si el password es correcto 

                    $auth= password_verify($password,$usuario['password']);

                    if($auth){
                        //El usuario es correcto 
                        session_start();

                        //llenar el arreglo de la sesión
                        $_SESSION['usuario']= $usuario['email'];   
                        $_SESSION['login']= true;   
                        
                        header('Location: /admin');

                      //  var_dump($auth);

                    }else{
                        $errores[]="El password es incorrecto";
                    }

        }else{
            $errores[]="El usuario no existe";
        }
   }
   
 /*   echo "<pre>";
   var_dump($errores);
   echo "</pre>";
 */

}

//  require 'includes/funciones.php';
  
  incluirTemplate('header');?>
    <main class="contenedor sección">
  
    <main class="contenedor sección contenido-centrado">
       <h1>Iniciar Seción</h1>
       <?php
         foreach($errores as $error):
       ?>
           <div class="alerta error">
               <?php echo $error;?>
           </div>
       <?php
         endforeach;
       ?>

       <form method= "POST" action="" class="formulario ">
           <fieldset>
               <legend>Email y Password</legend>
               <label for="">Email</label>
               <input type="email" placeholder="Email" id="email" name="email" require>
               <label for="">Password</label>
               <input type="password" placeholder="password" id="password" name="password" require>


           </fieldset>

           <input type="submit" value="Iniciar Sesión " class="boton boton-verde">

       </form>
     
    </main>
    </main>
    <?php  
incluirTemplate('footer');?>