<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

require '../../includes/app.php';

estaAutenticado();


/**Validar el id */
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location:/admin');
}
//base de datos


//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consulta para obtener todos los vendedores
$vendedores= Vendedor::all();

$errores = Propiedad::getErrores();

//ejecutare el código despues de que el usuario envia el formulario

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //asiganamos los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);
    //validación
    $errores = $propiedad->validar();
    //generar un nombre unico para img
    $nombreImagen =  md5(uniqid(rand(), true)) . ".jpg";
    //subida de archivo
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }
    //revisar que no haya errores, que el arreglo de errores este vacio para insertae datos a la base de datos
    if (empty($errores)) {
        if ($_FILES['propiedad']['tmp_name']['imagen']){
        //Amacenar la imagen
        $image->save(CARPETA_IMAGENES .  $nombreImagen);
        }
        $propiedad->guardar();

    }
}


incluirTemplate('header'); ?>
<main class="contenedor sección">
    <h1>Actualizar</h1>
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
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php
        include '../../includes/templates/formulario_propiedades.php'
        ?>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php


incluirTemplate('footer'); ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>