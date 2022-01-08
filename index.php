<?php

require 'includes/app.php'; //ahora se llama a app.php en lugar de funciones.php

incluirTemplate('header', $inicio = true); ?>
<main class="contenedor sección">
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

</main>
<section class="seccion contenedor">
  <h2>Casa y Depas en Venta</h2>
   <?php
    include 'includes/templates/anuncios.php'
   ?>
    <div class="alinear-derecha">
           <a href="anuncios.php" class="boton-verde">Todas las propiedades</a>
       </div>  
</section>
<section class="imagen-contacto">
  <h2>Encuentra la casa de sus sueños</h2>
  <p>Llena el formlario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
  <a href="contacto.php" class="boton-amarillo">Contactanos</a>
</section>
<div class="contenedor seccion seccion-inferior">
  <section class="blog">
    <h3>Nuestro Blog</h3>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp">
          <source srcset="build/img/blog1.jpg" type="image/jpeg">
          <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="entrada.php">
          <h4>Terraza en el techo de tu casa</h4>
          <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Administrador</span></p>
          <p>Consejos para construir una terraza en el techo</p>
        </a>
      </div>
    </article>
    <article class="entrada-blog">
      <div class="imagen">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp">
          <source srcset="build/img/blog2.jpg" type="image/jpeg">
          <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada blog">
        </picture>
      </div>
      <div class="texto-entrada">
        <a href="entrada.php">
          <h4>Guía para la decoración de tu hogar</h4>
          <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Administrador</span></p>
          <p>Maximixa el espacio de tu hogar con esta guía</p>
        </a>
      </div>
    </article>
  </section>
  <section class="testimoniales">
    <h3>testimoniales</h3>
    <div class="testimonial">
      <blockquote>
        El personal se comporto de una exelente forma, muy buena atención y la casa que ofrecieron cumple con todas las expectativas.
      </blockquote>
      <p>
        -Antonio Perez
      </p>
    </div>
  </section>
</div>
<?php
incluirTemplate('footer'); ?>