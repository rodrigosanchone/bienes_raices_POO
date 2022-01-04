<?php

namespace App;

/*Active Record   
  Patron de arquitectura para aplicaciones que almacena datos en BD Y CRUD
*/

class Propiedad
{
  //base de datos 
  protected static $db;  // al ser static el metodo tiene que ser static 
  protected static  $columnasDB = ['id', 'titulo', 'precio', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId', 'imagen'];


  //Errores y validaciones

  protected static $errores = []; // arreglo vació que llenamos si hay 



  public $id;
  public $titulo;
  public $precio;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $vendedorId;
  public $creado;

  public $imagen;

  //definir la conexión a la base de datos;
  public static function setDB($database)
  {
    Self::$db =  $database; // todo lo que es stati se referencia con $Self
  }


  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null; // todo lo que es public se referencia con $this 
    $this->titulo = $args['titulo'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->vendedorId = $args['vendedorId'] ?? 1;
  // $this->imagen = $args['imagen'];
    $this->creado = date('Y/m/d');
  }

 

    public function guardar(){
    {
      if (is_null($this->id)) {
       
        $this->crear();
      } else {
        //estamos guardando o creando un nuevo registro
        $this->actualizar();
      }
    }
    
    

    
  }

  public function crear()
  {

    //Sanitizar la entrada de los datos
    $atributos = $this->sanitizarDatos();
    //   $string = join(', ', array_keys($atributos)); // creo un string apartir de un arreglo
    //   $string = join(', ', array_values($atributos)); // creo un string apartir de un arreglo
    //echo "Guardando en la base de datos";
    // debuguear($string);
    //insertar en la base de datos
    $query = " INSERT INTO propiedades(";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ')";

    $resultado = self::$db->query($query); // de esta forma se inserta

   //mensdaje de exito
   if ($resultado) {
    header('Location: /admin?resultado=1');
  
}
    
  }

  public function actualizar()
  {
    //sanitizar los datos
    $atributos = $this->sanitizarDatos();
    $valores = [];
    foreach ($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }
    $query = " UPDATE propiedades SET ";
    $query .= join(', ', $valores);
    $query .= "WHERE id ='" . self::$db->escape_string($this->id) . "' ";
    $query .= "LIMIT 1";

    $resultado = self::$db->query($query);

    if ($resultado) {
  
      header('Location: /admin?resultado=2');
    }
  }

  //Eliminar un registro
  public function eliminar($id)
  {
    /**eliminar propiedad de la base de datos */
    $query = "DELETE FROM  propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    if ($resultado) {
      $this->borrarImagen($id);
      header('location: /admin?resultado=3');
    }
  }

  public function atributos()
  {
    //mapeo las columnas todas las columnas de la base de datos identifica y une los atributos de la base datos
    $atributos = [];

    foreach (self::$columnasDB as $columna) {
      if ($columna ===  'id') continue; // cuando se ejecuta esta condícion no se ejecuta el if , en este caso ignora el id y pasa al siguiente elemento del foreach
      $atributos[$columna] = $this->$columna;
    }
    return $atributos;
  }

  public function sanitizarDatos()
  {


    $atributos = $this->atributos();
    //debuguear( 'atributos');

    $sanitizado = [];
    foreach ($atributos as $key => $value) {
      // echo $key . $value;
      $sanitizado[$key] = self::$db->escape_string($value);
    }

    //debuguear($sanitizado);
    return $sanitizado;
  }

  //subida de archivos 
  public function setImagen($imagen)
  {
    //Elimina la imagen anterior
    if (!is_null($this->id)) { // si no esta cómo nulo
      $this->borrarImagen();
    }
    //asignar al atributo de imagen el nombre de la imagen
    if ($imagen) {
      $this->imagen = $imagen;
  
    }
  }

  //borrar imagen de la carpeta
  public function borrarImagen()
  {
    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
 
    if ($existeArchivo) {
     debuguear(unlink(CARPETA_IMAGENES . $this->imagen));
     
    }
  }

  //validación
  public static function getErrores()
  {
    return self::$errores;
  }

  public function validar() //código de validación
  {
    if (!$this->titulo) {
      self::$errores[] = "Debe añadir un titulo";
    }

    if (!$this->precio) {
      self::$errores[] = "Debe añadir un precio";
    }

    if (strlen($this->descripcion) < 50) {
      $errores[] = "Debe añadir una descripción y debe tener un minimo de 50 caracteres";
    }

    if (!$this->habitaciones) {
      self::$errores[] = "Debe añadir un número de habitaciones";
    }

    if (!$this->wc) {
      self::$errores[] = "Debe añadir un número de baños";
    }

    if (!$this->estacionamiento) {
      self::$errores[] = "Debe añadir un número de estacionamiento";
    }

    if (!$this->vendedorId) {
      self::$errores[] = "Elige un vendedor";
    }

    if (!$this->imagen) {
      self::$errores[] = "Tiene que ingresar una imagen ";
    }


    return self::$errores;
  }

  //listar todas las propiedades
  public static function all()
  {

    $query = "SELECT * FROM propiedades";

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  //busca una propiedad por su id
  public static function find($id)
  {
    $query = "SELECT * FROM propiedades WHERE id = ${id}";

    $resultado = self::consultarSQL($query);
    return array_shift($resultado);
  }

  public static function consultarSQL($query)
  {
    //consultar la base de datos
    $resultado = self::$db->query($query);
    //Iterar los resultados

    $array = [];
    while ($registro = $resultado->fetch_assoc()) {
      $array[] = self::crearObjeto($registro);
    }
    // debuguear($array);
    //liberar la memoria 
    $resultado->free();
    //retornar los resultados
    return $array;
  }

  protected static function crearObjeto($registro)
  {
    $objeto = new self; //crea nuevos obejtos de la clase propiedad
    foreach ($registro as $key => $value) {
      if (property_exists($objeto, $key)) {
        $objeto->$key = $value;
      }
    }
    return $objeto;
  }

  //sincronizar el objeto en memoria con los cambios realizado 
  public function sincronizar($args = [])
  {
    //  debuguear($args);
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}
