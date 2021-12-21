<?php

require 'includes/app.php';// cambio  funciones.php por app.php

incluirTemplate('header'); ?>
<main class="contenedor sección">

  <section class="seccion contenedor">
    <h2>Casa y Depas en Venta</h2>
    <?php
    $limite = 10;
    include 'includes/templates/anuncios.php'
    ?>

  </section>

</main>
<?php
incluirTemplate('footer'); ?>