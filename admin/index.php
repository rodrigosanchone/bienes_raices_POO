<?php

require '../includes/app.php';


estaAutenticado();



 
 //Importar la conexión  
 //require '../includes/config/database.php';
  
 $db = conectarBD();

 //Escribir el Query
 $query= "SELECT * FROM propiedades";

 //Consultar la base de datos

$resultadoConsulta= mysqli_query($db,$query); 

//muestra mensjae condicional
 $resultado = $_GET['resultado']?? null;// este código busca este valor y  si no existe le asigna null

 if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $id= $_POST['id'];
    $id= filter_var($id,FILTER_VALIDATE_INT); //VALIDO QUE SE UN NÚMERO
    IF($id){
      /**Eliminar la imagen */
      $query= "SELECT imagen FROM propiedades WHERE id = ${id}";

      $resultado= mysqli_query($db, $query);
      $propiedad= mysqli_fetch_assoc($resultado);

      unlink('../imagenes/'. $propiedad['imagen']);

      /**eliminar propiedad de la base de datos */
      $query = "DELETE FROM  propiedades WHERE id = ${id}"; 
      $resultado = mysqli_query($db, $query);
      if($resultado){
         header('location: /admin?resultado=3');
      } 
    }
 }

 
 //var_dump($resultado);

 //Incluimos un template

  
  incluirTemplate('header');?>
    <main class="contenedor sección">
      <?php
        if(intval($resultado)===1):
      ?>
          <p class="alerta exito">Anuncio creado correctamente</p>
       <?php 
       elseif(intval($resultado)===2):
       ?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
        <?php 
       elseif(intval($resultado)===3):
       ?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
      <?php
        endif;
      ?>
       <h1>Administrador de propiedades</h1>
       <a href="/admin/propiedades/crear.php" class="boton boton-verde">Crear Nueva Propiedad</a>
      <!--  <a href="/admin/propiedades/crear.php" class="boton boton-verde">Editar  Propiedad</a>
       <a href="/admin/propiedades/crear.php" class="boton boton-verde">Borrar Propiedad</a> -->
      
      <!--Mostrar los resultados -->
       <table class="propiedades">
         <thead>
           <tr>
             <th>ID</th>
             <th>Titulo</th>
             <th>Imagen</th>
             <th>Precio</th>
             <th>Acciones</th>
           </tr>
         </thead>
         <tbody>
           <?php 
             while($propiedad=mysqli_fetch_assoc($resultadoConsulta)):
            ?>
           <tr>
             <td><?php echo $propiedad['id'];?></td>
             <td><?php echo $propiedad['titulo'];?></td>
             <td><img src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="" class="imagenTabla"></td>
             <td>$ <?php echo $propiedad['precio'];?></td>
             <td>
               <form method="POST" class="w1-00">
               <input type="hidden" name="id" value="<?php echo $propiedad['id']?>">  
               <input  class="boton-rojo-block" type="submit" value="Eliminar">
               </form>
               
               <a href="/admin/propiedades/actualizar.php?id=<?php  echo $propiedad['id'];?>" class="boton-amarillo-block">Actualizar</a>
             </td>
           </tr>
           <?php
             endwhile;
           ?>
         </tbody>
       </table>
    </main>
       <!--Cerrar la conexión-->
    <?php  
  
     mysqli_close($db);
  
incluirTemplate('footer');?>