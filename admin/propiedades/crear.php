<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
/* $propiedad = new Propiedad;

debuguear($propiedad); */

$db = conectarBD();

$propiedad = new Propiedad;

/* $propiedad = new Propiedad;

/* echo "<pre>";
var_dump($propiedad);
echo  "</pre>"; */
/*
debuguear($propiedad); */


estaAutenticado();

//base de datos
$db = conectarBD();
//consultar para obtener los vendedores
$consulta  = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
/*   echo "<pre>";
  var_dump($_SERVER['REQUEST_METHOD']);
 echo "</pre>"; */

//arreglo con mensaje de errores
$errores = Propiedad::getErrores();





//ejecutare el código despues de que el usuario envia el formulario

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    //crear nueva instancia 
    $propiedad = new Propiedad($_POST);
 
    /**subida de archivos */
      
    //generar un nombre unico para img
    $nombreImagen =  md5(uniqid(rand(), true)) . ".jpg";

    //Setear la imagen
     //Realizanmos un resize a la imagen con Intervetion
     if($_FILES['imagen']['tmp_name']){
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
     }
    
    //validar
    $errores = $propiedad->validar();

    //revisar que no haya errores, que el arreglo de errores este vacio para insertae datos a la base de datos
    if (empty($errores)) {

         //Crear la carpeta para subir imagenes
         if(! is_dir(CARPETA_IMAGENES)){
            mkdir(CARPETA_IMAGENES);
        }
        //subir la imagen
       
        //guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);
       
        //guarda en la base de datos     
        $resultado= $propiedad->guardar();
       //mensdaje de exito
        if ($resultado) {
            echo "Insertado Correctamente";
            header('Location: /admin?resultado=1');
        }
    }
}



incluirTemplate('header'); ?>
<main class="contenedor sección">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php
    foreach ($errores as $error) :
    ?>
        <div class="alerta error">
            <?php
            echo $error;
            ?>
        </div>

    <?php
    endforeach;
    ?>
    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <?php
          include '../../includes/templates/formulario_propiedades.php'
        ?>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php


incluirTemplate('footer'); ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>