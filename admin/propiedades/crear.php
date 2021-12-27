<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
/* $propiedad = new Propiedad;

debuguear($propiedad); */

$db = conectarBD();


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

debuguear($errores);

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

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

//require '../../includes/funciones.php';

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
        <fieldset>
            <legend>Información General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value="<?php echo $titulo; ?>">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen:</label>
            <input type="file" id="precio" accept="image/jpeg, image/png" name="imagen">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion">
             <?php echo $descripcion; ?>
            </textarea>
        </fieldset>
        <fieldset>
            <legend>Información de la Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ejemplo 3" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ejemplo 3" min="1" max="9" name="wc" value="<?php echo $wc; ?>">

            <label for="estacionamineto">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ejemplo 3" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedorId">
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
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>
<?php


incluirTemplate('footer'); ?>
<script src="build/js/bundle.min.js"></script>
</body>

</html>