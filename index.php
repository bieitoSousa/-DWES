<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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
        if (isset($_POST['enviar'])) {
            $agenda = Agenda::getAgenda();
            $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            if (Agenda::VerficarDatos($nombre, $telefono)){
                // si los dos datos coinciden 
            }else{
                // si no coincide alguno de los datos 
                if(Agenda::VerificarClave($nombre)){
                  //coincide la clave  
                }
                elseif (Agenda::VerificarValor($telefono)){
                    //coincide el valor 
                }
                else {
                   // no coincide nada 
                      $agenda->rellenarArray($nombre, $telefono);
                    }
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
