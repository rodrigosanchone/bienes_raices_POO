<?php

require '../includes/app.php';


estaAutenticado();

 use App\Propiedad;
 use App\Vendedor;

//implementar un metodo para obtener todas las propiedades

 $propiedades = Propiedad::all();
 $vendedores= Vendedor::all();


  
//muestra mensjae condicional
 $resultado = $_GET['resultado']?? null;// este código busca este valor y  si no existe le asigna null

 if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $id= $_POST['id'];
    $id= filter_var($id,FILTER_VALIDATE_INT); //VALIDO QUE SE UN NÚMERO
    if($id){
       $tipo = $_POST['tipo'];
       if(validarTipoContenido($tipo)){
         //compara lo que vamos a eliminar
         if($tipo==='vendedor'){
           $vendedor = Vendedor::find($id);
          $vendedor->eliminar($id); 
         }else if($tipo==='propiedad'){
           $propiedad = Propiedad::find($id);
          $propiedad->eliminar($id); 
         }

       }
  
        
    }
 }

 
 //var_dump($resultado);

 //Incluimos un template

  
  incluirTemplate('header');?>
    <main class="contenedor sección">
      <?php
       $mensaje = mostrarNotificaciones(intval($resultado));
         if($mensaje){ ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
        <?php }
       
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
         <tbody><!--Mostrar los resultados -->
           <?php 
             foreach($propiedades as $propiedad):
            ?>
           <tr>
             <td><?php echo $propiedad->id;?></td>
             <td><?php echo $propiedad->titulo;?></td>
             <td><img src="/imagenes/<?php echo $propiedad->imagen;?>" alt="" class="imagenTabla"></td>
             <td>$ <?php echo $propiedad->precio;?></td>
             <td>
               <form method="POST" class="w1-00">
                <input type="hidden" name="id" value="<?php echo $propiedad->id?>">  
                <input type="hidden" name="tipo" value="propiedad">  
                <input  class="boton-rojo-block" type="submit" value="Eliminar">
               </form>
               
               <a href="/admin/propiedades/actualizar.php?id=<?php  echo $propiedad->id;?>" class="boton-amarillo-block">Actualizar</a>
             </td>
           </tr>
           <?php endforeach;?>
    
         </tbody>
       </table>
       <h2>Vendedores</h2>
       <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Ingresar un nuevo vendedor</a>
       <table class="propiedades">
         <thead>
           <tr>
             <th>ID</th>
             <th>Nombre</th>
             <th>Teléfono</th>
             <th>Acciones</th>
           </tr>
         </thead>
         <tbody><!--Mostrar los resultados -->
           <?php 
             foreach($vendedores as $vendedor):
            ?>
            

           <tr>
             <td><?php echo $vendedor->id;?></td>
             <td><?php echo $vendedor->nombre . " " .$vendedor->apellido  ;?></td>
             <td><?php echo $vendedor->telefono;?></td>
             <td>
               <form method="POST" class="w1-00">
                <input type="hidden" name="id" value="<?php echo $vendedor->id?>">  
                <input type="hidden" name="tipo" value="vendedor">  
                <input  class="boton-rojo-block" type="submit" value="Eliminar">
               </form>
               
               <a href="/admin/vendedores/actualizar.php?id=<?php  echo $vendedor->id;?>" class="boton-amarillo-block">Actualizar</a>
             </td>
           </tr>
           <?php endforeach;?>
    
         </tbody>
       </table>

    </main>
       <!--Cerrar la conexión-->
    <?php  
  
   
  
incluirTemplate('footer');?>