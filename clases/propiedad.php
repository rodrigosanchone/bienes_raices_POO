<?php

namespace App;

/*Active Record   
  Patron de arquitectura para aplicaciones que almacena datos en BD Y CRUD

*/
class Propiedad{
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


    public function __construct($args =[])
    {    
         $this->id = $args['id'] ?? '';
         $this->ttulo = $args['titulo'] ?? '';
         $this->precio =$argss['precio'] ?? '';
         $this->descripcion = $args['descripcion']?? '';
         $this->habitaciones = $args['habitaciones']?? '';
         $this->wc = $args['wc']?? '';
         $this->estacionamiento = $args['estacionamineto']?? '';
         $this->vendedorId = $args['vendedorId']?? '';
         $this->creado =$args['creado']?? '';
    }
}