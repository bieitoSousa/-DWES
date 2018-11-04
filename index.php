<!DOCTYPE html>
<!--
Enunciado.
Debes programar una aplicación para mantener una pequeña agenda en una única página web programada en PHP.
La agenda almacenará únicamente dos datos de cada persona: 
su nombre y un número de teléfono. 
Además, no podrá haber nombres repetidos en la agenda.

En la parte superior de la página web se mostrará el contenido de la agenda.
 En la parte inferior debe figurar un sencillo formulario con dos cuadros de texto,
 uno para el nombre y otro para el número de teléfono.

Cada vez que se envíe el formulario:

Si el nombre está vacío, se mostrará una advertencia.
Si el nombre que se introdujo no existe en la agenda, y el número de teléfono no está vacío, se añadirá a la agenda.
Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el número de teléfono anterior.
Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono, se eliminará de la agenda la entrada correspondiente a ese nombre.
Criterios de puntuación. Total 10 puntos.
Se valorará con un punto la consecución de cada uno de los siguientes items:

Generar la estructura de la página PHP.
Mostrar los contactos existentes en la agenda.
Generar el formulario de introducción de nuevo contacto.
Introducir los datos de la agenda como campos ocultos en el formulario.
Comprobar los datos enviados por el formulario, mostrando una advertencia cuando no se cubre el nombre.
Introducir en la agenda los datos de un nuevo contacto.
Modificar el teléfono de un contacto ya existente.
Eliminar de la agenda un contacto.
Utilizar un array asociativo.
Introducir comentarios en el código.
Recursos necesarios para realizar la Tarea.
Ordenador con PHP, servidor web Apache y entorno de desarrollo NetBeans, correctamente instalado y configurado según lo visto en el tema anterior.
Consejos y recomendaciones.
Se recomienda emplear como apoyo en el desarrollo del examen un navegador con acceso a Internet, para poder consultar el manual online de PHP .
Indicaciones de entrega.
Una vez realizada la tarea elaborarás un único documento donde figuren las respuestas correspondientes. El envío se realizará a través de la plataforma de la forma establecida para ello, y el archivo se nombrará siguiendo las siguientes pautas:

apellido1_apellido2_nombre_SIGxx_Tarea

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> Mi Agenda </title>
    </head>
    <body>
        
       

      <div> 
          <?php
          // <!-- 
          include 'Agenda.php';
         // $array_asociativo["Nombre"]="Telefono";
        if (isset($_POST['enviar'])) { // si se presiona el boton enviar 
            $agenda = Agenda::getAgenda();
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];

                // si no coincide alguno de los datos 
                if(Agenda::VerificarClave($nombre)){ //coincide la clave 
                 
                   if(1==1){ // si hay campo de telefono
                  // modificamos el telefono
                         $agenda->modificarTelefono($nombre , $telefono);
                   }elseif(2==1){ // Si campo de telefono esta bacio
                          $agenda->eliminarContacto($nombre);     
                  }else{echo "error 1";}
                
                }else{
                    if (4==4){ // si hay campo telefono
                        // creamos un contacto
                      $agenda->rellenarArray($nombre , $telefono);  
                    }else { echo "error , introduzca los datos correctamente"; }
                }
            
            $agenda-> mostrarAgenda();
        }else{
            
        }
// -->
         ?>
      </div>
        <div> 
            <form action=" <?php echo htmlspecialchars( $_SERVER['PHP_SELF'])?> "
              method="post" name="agenda">
             Cuestionario </br> 
             Nombre   :  <input type="text" name="nombre"/></br>
             Telefono : <input type="text" name="telefono"/></br>
              <input type="submit" value="Enviar" name="enviar" />
        </div>  
        
    </body>
</html>
