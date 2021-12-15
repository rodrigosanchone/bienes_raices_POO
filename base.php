<?php

  require 'includes/funciones.php';
  
  incluirTemplate('header',$inicio = true);?>
    <main class="contenedor sección">
  
    <main class="contenedor sección contenido-centrado">
       <h1>Iniciar Seccion</h1>

       <form method= "POST" action="" class="formulario ">
           <fieldset>
               <legend>Email y Password</legend>
               <label for="">Email</label>
               <input type="email" placeholder="Email" id="email">
               <label for="">Password</label>
               <input type="password" placeholder="password" id="password">


           </fieldset>

           <input type="submit" value="Iniciar Sesión " class="boton boton-verde">

       </form>
     
    </main>
    </main>
    <?php  
incluirTemplate('footer');?>