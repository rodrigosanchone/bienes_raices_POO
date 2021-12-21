<?php

 // require 'includes/funciones.php';
  require 'includes/app.php';
  
  incluirTemplate('header',$inicio = true);?>
    
    <main class="contenedor sección">
      <h1>Conoce sobre nosotros</h1>
      <div class="contenido-nosotros">
        <div class="imagen">
          <picture>
            <source srcset="build/img/nosotros.webp" type="image/webp">
            <source srcset="build/img/nosotros.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobres nosotros">
          </picture>
          </div>
          <div class="texto-nosotros">
            <blockquote>
              25 Años de experiencia
            </blockquote>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo est nobis recusandae ullam velit hic qui molestiae eos placeat, numquam laudantium eveniet delectus at eaque. Ab veniam aliquid eaque molestiae!
            </p>
            <p>
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eum quisquam recusandae neque esse
            </p>
        </div>
      </div>
    </main>
    <section class="contenedor sección">
      <h1>Más Sobre Nosotros</h1>

      <div class="iconos-nosotros">
          <div class="icono">
            <img src="build/img//icono1.svg" alt="Icono Seguridad" loading="lazy ">
            <h3>Seguridad</h3>
            <p>Consectetur adipisicing elit. Sed quibusdam deserunt provident excepturi. Nam veritatis maiores ratione, in debitis excepturi repudiandae architecto ipsa vitae quis vel tenetur, aperiam, iure cum.</p>
          </div>
          <div class="icono">
            <img src="build/img//icono2.svg" alt="Icono Precio" loading="lazy ">
            <h3>Precio</h3>
            <p>Consectetur adipisicing elit. Sed quibusdam deserunt provident excepturi. Nam veritatis maiores ratione, in debitis excepturi repudiandae architecto ipsa vitae quis vel tenetur, aperiam, iure cum.</p>
          </div>
          <div class="icono">
            <img src="build/img//icono3.svg" alt="Icono Tiempo" loading="lazy ">
            <h3>Tiempo</h3>
            <p>Consectetur adipisicing elit. Sed quibusdam deserunt provident excepturi. Nam veritatis maiores ratione, in debitis excepturi repudiandae architecto ipsa vitae quis vel tenetur, aperiam, iure cum.</p>
          </div>
      </div>
   
    </section>
    <?php  
incluirTemplate('footer');?>