<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Agenda
 *
 * @author bieito
 */
class Agenda {
           private static $agenda = NULL;
           public $titulo = "Agenda" ;  
           public  $campo1 = "nombre" ;
           public $campo2 = "telefono" ;  
           public static  $array_asociativo = array();
           private $clave;
           private $valor;
           private $ExisteClave;
           private $clave_EnBlanco; // almacenamos si la ultima clave introducidad esta en blanco 
           private $valor_EnBlanco; // almacenamos si el ultimo valor introducidad esta en blanco 
           private $accion;
           private $error = false;  // true si hay errores
           private $errorMsg;  // almacenamos los mensajes de error 
           private $warning = false ;  // true si se producen warning
           private $warningMsg;   // almacenamos mesnages de warning
           private $msg; // almaceno todos los mesages;
           //private $contadorRellenarArray;
           //private $contadorAgenda;
          // private $contadorInstancias;
           
                /***************************************** constructor Singleton  *******************************************************/
                private function __construct(){// Código del constructor.
                    $this->msg= $this->msg. "constructor Singleton"."</br>";
                }
                // Método que nos devuelve la instancia de la clase.
                public static function getAgenda(){
                    if(self::$agenda == NULL)// Si la clase no está instanciada la creamos.
                        {self::$agenda = new Agenda();
                        // $this->contadorInstancias++;
                        }  
                    return self::$agenda;// Devolvemos la instancia de la clase
                }
                
                
                 /*****************************************  FIN constructor Singleton  *******************************************************/
                
                
                 /***************************************** Verificar parametros ***************************************************************/
                
                
                // si la clave esta en blanco devolvemos y guardamos true , si hay contenido guardamos  y devolvemos false
                 private function claveEnBlanco($nombre){
                     if (!isset($nombre)){ $this->clave_EnBlanco=true;return true; }else{ $this->clave_EnBlanco=false; return false;}
                 }
                 // si la calve esta en blanco devolvemos y guardamos false  , si hay contenido guardamos true y devolvemso true
                 private function valorEnBlanco($telefono){
                      if (!isset($telefono)){$this->valor_EnBlanco =true ; return true; }else{ $this->valorEnBlanco =falso ;return false;}
                 }
                 // si la 
                  private  function claveRepetida ($nombre) {
                   if (array_key_exists($nombre, $this->array_asociativo)) {
                        $this->ExisteClave = true;
                        return true;
                    } else {
                         $this->ExisteClave = false;
                         return false;
                    }
                }
                 
                 /*****************************************  FIN Verificar parametros ***************************************************************/
                 
                 
                 /***************************************** ACCIONES INTERNAS ***************************************************************/
                 // Añadir un contacto a nuestro array asociativo
                 private function addContacto( $nombre , $telefono ){
                           $this->array_asociativo[$nombre]=$telefono; // vamso guardando nuestros contactos
                           $this->contadorRellenarArray++;
                 }
                  // Eliminar un contacto de nuestro array asociativo 
                 private function eliminarContacto($nombre ) {
                   unset($this->array_asociativo[$nombre]);// 
                 }  
                 //modificar nuestro arry asociativo
                 private function modificarTelefono($nombre ,$telefono) {
                   $remplazos=array();
                   $base = array(); 
                      $base[]= $this->array_asociativo;
                      $remplazos[$nombre]=$telefono;
                      $this->array_asociativo = array_replace($base, $remplazos); // el array es el resultado de superponer los valores de $remplazos en $base
                    
               } 
               /*****************************************FIN ACCIONES INTERNAS ***************************************************************/
                
               /***************************************** ACCIONES EXTERNAS ********************************************************************/
               
                 // Analizamos los datos - si estan en blanco - si estan repetidos
                 public function tratamientoDatos($nombre , $telefono){ 
                     $this->clave = $nombre; // guardo la inf en una variable privada para trabajar con ella.
                     $this->valor = $telefono; // guardo la inf en una variable privada para trabajar con ella.
                      $this->msg= $this->msg.  "............................................... Analizando Datos ................................................";
                      $this->msg= $this->msg.  "nombre introducido : $this->nombre , telefono introducido: $this->telefono "."</br>"; //  muestra los parametros de nombre y telefono
                     
                     if (claveRepetida($nombre))  { $this->msg= $this->msg.  "Clave : ya en uso"."</br>";} else {  $this->msg= $this->msg.  "Clave : nueva "."</br>";} // repetida true || no False
                     if (claveEnBlanco($nombre))   { $this->msg= $this->msg.  "Clave : en blanco"."</br>";} else { $this->msg= $this->msg.  "Clave : $this->nombre"."</br>";} // clave en blanco true || no false
                     if (valorEnBlanco($telefono)) { $this->msg= $this->msg.  "Valor : en blanco"."</br>";} else { $this->msg= $this->msg.  "Valor : $this->telefono"."</br>";} // valor en blanco true || no false
                      $this->msg= $this->msg.  "...............................................  Fin Analizando Datos ...........................................";
                     
                     //  Si el nombre está vacío, se mostrará una advertencia.
                     if ($this->clave_EnBlanco){
                         $this->error=true; $this->errorMsg =$this->errorMsg. " NO SE A INTRODUCIDO EL DATO DEL NOMBRE ";
                     }else{
                     //Si el nombre que se introdujo no existe en la agenda, y el número de teléfono no está vacío, se añadirá a la agenda.
                         if (!$this->ExisteClave && !$this->valor_EnBlanco ){
                             addContacto( $nombre , $telefono ); // añado contacto
                             $this->accion =  $this->accion. "Actualizada lista de contactos clave : $this->clave - valor : $this->valor "."</br>";}
                     //Si el nombre que se introdujo ya existe en la agenda y no se indica número de teléfono, se eliminará de la agenda la entrada correspondiente a ese nombre.
                         if ( $this->ExisteClave &&  $this->valor_EnBlanco){  
                             eliminarContacto($nombre);  // elimino el contacto  
                             $this->accion =$this->accion ."borrar numero con clave:  $this->clave"."</br>";}
                     //Si el nombre que se introdujo ya existe en la agenda y se indica un número de teléfono, se sustituirá el número de teléfono anterior.
                         if ( $this->ExisteClavee && !$this->valor_EnBlanco){
                             modificarTelefono($nombre ,$telefono);// modifico los datos del telefono
                             $this->accion = $this->accion." Para el contacto:   $this->clave  se sustitulle el numero de telefono por $this->valor "."</br>";
                         }
                     }
                }
               // muestra la tabla con la agenda
                 public function mostrarAgenda() {
                    // $this->contadorAgenda++;
                     $entradasArray = count($this->array_asociativo);
                    if (   $entradasArray  > 0 ) {
                              echo "<div>"
                                        . "<table >"
                                        . "     <tr>"
                                        . "             <td> $this->titulo </td>"
                                        . "     </tr>"
                                         . "     <tr>"
                                        . "             <td> $this->campo1 </td>"
                                        . "             <td> $this->campo2 </td>"
                                        . "     </tr>" ;
                               // for ($i=0; $i< count($array_asociativo); $i++){  } 
                                foreach($this->array_asociativo as $nom=>$tlf){

                                    echo  "     <tr>"
                                        . "             <td> $nom </td>"
                                        . "             <td> $tlf </td>"
                                        . "     </tr>";

                                }             
                                  echo  "     <tr>"
                                        . "             <td>   clave  </td>"
                                        . "             <td> $this->clave  </td>"
                                        . "             <td> La clave esta en blanco : $this->clave_EnBlanco  </td>"
                                        . "     </tr>";
                                  
                                   echo  "     <tr>"
                                        . "             <td>  Valor  </td>"
                                        . "             <td> $this->valor  </td>"
                                        ."              <td> El valor esta en blanco : $this->valor_EnBlanco  </td>"
                                        . "     </tr>";
                                   
                                
                                echo  "</table>"
                                        . "</div>"; 
                     }else{
                        echo "Agenda sin contactos" ;
                     }
                }
              // muestra los mensages del programa
                
                public function mostrarMensages() {
                    echo                  "<div>"
                                        . "<table >";
                    
                    
                    
                    
                    if ($this->error) {
                       echo               "         <tr>    <td>  Mensages de Error  </td> </tr>"
                                        . "          <tr>    <td> $this->errorMsg  </td> </tr>   ";  
                    }
                    if ($this->warning) {
                        echo               "         <tr>    <td>  Mensages de Warning  </td> </tr>"
                                        . "          <tr>    <td> $this->warningMsg  </td> </tr>   ";  
                    }
                     echo               "         <tr>    <td>  Acciones realizadas por el programa  </td> </tr>"
                                        . "          <tr>    <td> $this->accion  </td> </tr>   ";
                     echo               "         <tr>    <td>  Mensages de Funcionamiento del programa  </td> </tr>"
                                        . "          <tr>    <td> $this->msg  </td> </tr>   ";
                     
                       echo  "</table>"
                                        . "</div>"; 
                }
                
                
                
                /***************************************** FIN  ACCIONES EXTERNAS ********************************************************************/ 
                
                /*********************** Verificaciones Static pueden alterar el programa ****************************************/
                
               
                 public static function verificarClave ($nombre) {
                   if (array_key_exists($nombre, $this->array_asociativo)) {
                        return true;
                    } else {
                         return false;
                    }
                }
                
                public static function verificarValor ($telefono) {
                  $clave = array_search($telefono, $this->array_asociativo); // quitamos la clave apartir del valor , devuelve null si no encuentra
                  if ($clave != null){ 
                      return true;
                    } else {
                        return false;
                    }
                } 

               public static function verficarDatos($nombre ,$telefono) { // quitamos la clave apartir del valor, y vemos si coinciden.
                  $clave = array_search($telefono, $this->array_asociativo); 
                  if ($clave == $nombre) {
                      return true;
                  } else {return false;}
               }
}
