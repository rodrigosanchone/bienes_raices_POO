<?php

/* echo '<pre>';
 var_dump($_GET);
echo '</pre>'; */


require '../../includes/funciones.php';
$auth= estaAutenticado();

if(!$auth){
    header('Location: /');
}


/**Validar el id */
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location:/admin');
}
//base de datos

require '../../includes/config/database.php';
$db = conectarBD();
//Obtener los datos de la propiedad

$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);
//consultar para obtener los vendedores
$consulta  = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);
/*   echo "<pre>";
  var_dump($_SERVER['REQUEST_METHOD']);
 echo "</pre>"; */

//arreglo con mensaje de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$wc = $propiedad['wc'];

$imagenPropiedad = $propiedad['imagen'];

$vendedorId = $propiedad['vendedorId'];

//ejecutare el código despues de que el usuario envia el formulario

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    /*   echo "<pre>";
    var_dump($_POST);
    echo "</pre>";  */

    /*  echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";  */

    //exit;

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');


    //Asignar file hacia una variable

    $imagen = $_FILES['imagen'];

    //  var_dump($imagen);
    //exit;

    if (!$titulo) {
        $errores[] = "Debe añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "Debe añadir un precio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "Debe añadir una descripción y debe tener un minimo de 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "Debe añadir un número de habitaciones";
    }

    if (!$wc) {
        $errores[] = "Debe añadir un número de baños";
    }

    if (!$estacionamiento) {
        $errores[] = "Debe añadir un número de estacionamiento";
    }

    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    /*   if(!$imagen['name'] || $imagen['error']){
        $errores[] = "Tiene que ingresar una imagen";
    } */



    $medida = 1000 * 1000;

    if ($imagen['size'] > $medida) {
        $errores[] = "La imagén no debe ser tan pesada";
    }


    /*  echo "<pre>";
    var_dump($errores);
    echo   "</pre>"; */

    //exit;

    //revisar que no haya errores, que el arreglo de errores este vacio para insertae datos a la base de datos
    if (empty($errores)) {
        $carpetaImagen = '../../imagenes/';

               /**Crear carpeta */
        if (!is_dir($carpetaImagen)) {
            mkdir($carpetaImagen);
        }

        $nombreImagen = '';
        /**subida de archivos */
        if ($imagen['name']) {
            // echo "Si hay una nueva  imagen";
            /**Eliminar la imagen previa  */
            unlink($carpetaImagen . $propiedad['imagen']);

            //generar un nombre unico para img
            $nombreImagen =  md5(uniqid(rand(), true)) . ".jpg"; 

            //subir la imagen

            move_uploaded_file($imagen['tmp_name'], $carpetaImagen . $nombreImagen);
        }else{
            $nombreImagen = $propiedad['imagen'];
        }
    
 


        //insertar en la base de datos
        $query = " UPDATE propiedades SET titulo= '${titulo}', precio='${precio}', imagen='${nombreImagen}', descripcion='${descripcion}',habitaciones=${habitaciones},wc=${wc},estacionamiento=${estacionamiento},vendedorId=${vendedorId} WHERE id =${id}";

        /*   echo $query;

         exit; */

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "Insertado Correctamente";
            header('Location: /admin?resultado=2');
        }
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
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value="<?php echo $titulo; ?>">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen:</label>
            <input type="file" id="precio" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad ?>" alt="imagen: /<?php echo $imagenPropiedad ?> " class="imagen-small">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10">
            <?php echo $descripcion; ?>
            </textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ejemplo 3" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ejemplo 3" min="1" max="9" name="wc" value="<?php echo $wc; ?>">

            <label for="estacionamientoto">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ejemplo 3" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">----</option>
                <?php
                while ($vendedor = mysqli_fetch_assoc($resultado)) :
                ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'] ?>
                    </option>
                <?php
                endwhile;
                ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>
<?php


incluirTemplate('footer'); ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>