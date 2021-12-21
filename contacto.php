<?php

  //require 'includes/funciones.php';
  
  require 'includes/app.php';
  
  incluirTemplate('header');?>
    
    <main class="contenedor sección">
        <h1>Contacto</h1>
        <picture>
          <source srcset="build/img/destacada3.webp" type="image/webp"> 
          <source srcset="build/img/destacada3.jpg" type="image/jpg"> 
          <img src="build/img/destacada3.jpg" alt="">
        </picture>
        <h2>Llene el formulario</h2>
        <form action="formulario" class="formulario">
            <fieldset>
              <legend>Información Personal</legend>
              <label for="nombre">Nombre</label>
              <input type="text" placeholder="Nombre" id="nombre">
              <label for="email">Email</label>
              <input type="email" placeholder="Email" id="email">
              <label for="telefono">Teléfono</label>
              <input type="tel" placeholder="Nombre" id="telefono">
              <label for="mensaje">Mensaje</label>
             <textarea name="" id="mensaje" cols="30" rows="10"></textarea>
              
            </fieldset> 
            <fieldset>
              <legend>Información de la propiedad</legend>
              <label for="opciones">Vende O Compra</label>
              <select  id="opciones">
                <option value="Compra">Compra</option>
                <option value="Vende">vende</option>
              </select>

              <label for="presupuesto">Precio o Presupuesto</label>
              <input type="number" placeholder="Precio o Presupuesto" id="presupuesto">
            
           
              
            </fieldset> 

            <fieldset>
              <legend>Contacto</legend>
              <p>¿Cómo desea ser contactado?</p>
              <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">
                <label for="contactar-email">Email</label>
                <input name="contacto" type="radio"  value="email" id="contactar-email">
              </div>
              
              <p>Si eligió teléfono, elija la fecha y la hora</p>

              <label for="telefono">Fecha</label>
              <input type="date" id="fecha">

              <label for="hora">Hora</label>
              <input type="time" id="hora" min="9:00" max="18:00">
            </fieldset> 
            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </main>
    <?php  
incluirTemplate('footer');?>