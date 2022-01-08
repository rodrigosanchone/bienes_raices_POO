<?php

require '../../includes/app.php';
use App\Vendedor;



//valido que el usuario este autenticado para ver esta pag
estaAutenticado();


//validar que sea un ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);


if(!$id){
  header('Location: /admin');
}

//obtener el arreglo del vendedor
$vendedores= Vendedor::all();
$vendedor = Vendedor::find($id);

$errores= Vendedor::getErrores();

if($_SERVER['REQUEST_METHOD']==='POST'){
  //asignar los valores
  $args= $_POST['vendedor'];
  //sincronizar obejto en memoria 
  $vendedor->sincronizar($args);
  //validación
  $errores = $vendedor->validar();
  if(empty($errores)){
      $vendedor->guardar();
  }
}


incluirTemplate('header');

   


?>

<main class="contenedor sección">
    <h1>Actualizar vendedor</h1>
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
    <form  class="formulario" method="POST" >
        <?php
        include '../../includes/templates/formulario_vendedores.php'
        ?>
        <input type="submit" value="Guardar Cambios" class="boton boton-verde">
    </form>
</main>


<?php

incluirTemplate('footer');
?>