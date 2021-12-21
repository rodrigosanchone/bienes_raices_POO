<?php
  /**Importar base de datos */
  // Esta manera ya no sera necesaria
  //require __DIR__.'/../config/database.php'; //puedo usar esta manera o la que sigue 
  //require '/includes/config/database.php'; //la ruta relativa es hacia el index o anuncios.php
  $db = conectarBD();

  /**Consultar */
  $query = "SELECT * FROM propiedades Limit ${limite}";


  /**Obetener los resultados  */
  $resultado = mysqli_query($db, $query);

?>
<div class="contenedor-anuncios">
     <?php while($propiedad= mysqli_fetch_assoc($resultado)): ?>
          <div class="anuncio" >
            <picture>
             <!--   <source src="build/img/anuncio1.webp" type="image/webp"> 
               <source src="build/img/anuncio1.jpg" type="image/jpeg">  -->
               <img src="/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio" loading="lazy">
            </picture>
            <div class="contenido-anuncio" >
              <h3><?php echo $propiedad['titulo']; ?></h3>
              <p><?php echo $propiedad['descripcion'];?> </p>
              <p class="precio"><?php echo $propiedad['precio'];?></p>
              <ul class="iconos-caracteristicas">
                 <li>
                   <img  loading="lazy" src="build/img/icono_wc.svg" alt="icono_wc">
                   <p><?php echo $propiedad['wc'];?></p>
                 </li>
                 <li>
                   <img  loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono_estacionamiento">
                   <p><?php echo $propiedad['estacionamiento'];?></p>
                 </li>
                 <li>
                   <img  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono_dormitorio">
                   <p><?php echo $propiedad['habitaciones'];?></p>
                 </li>
              </ul>
              <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class="boton-amarillo-block">Ver propiedad</a>
            </div><!--Contenido Anuncio-->
          </div><!--Anuncio-->
          <?php endwhile?>
     
         
        </div><!--Contenedor Anuncios-->

        <?php
         /**Cerrar la conexión */
         mysqli_close($db);
        ?>