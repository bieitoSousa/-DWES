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
           private $contadorRellenarArray;
           private $contadorAgenda;
           private $contadorInstancias;

                private function __construct(){// Código del constructor.
                    echo "constructor Singleton.";
                }
                
                public static function getAgenda(){// Método que nos devuelve la instancia de la clase.
                    if(self::$agenda == NULL)// Si la clase no está instanciada la creamos.
                        {self::$agenda = new Agenda();
                         $this->contadorInstancias++;
                        }  
                    return self::$agenda;// Devolvemos la instancia de la clase
                }


                public function rellenarArray($nombre , $telefono){
                           $this->array_asociativo[$nombre]=$telefono;
                           $this->contadorRellenarArray++;
                             }
                 public function mostrarAgenda() {
                     $this->contadorAgenda++;
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
                                        . "             <td>  Entradas del array  </td>"
                                        . "             <td> $entradasArray </td>"
                                        . "     </tr>";
                                  
                                   echo  "     <tr>"
                                        . "             <td>  metodo rellenar array  </td>"
                                        . "             <td> $this->contadorRellenarArray </td>"
                                        . "     </tr>";
                                   
                                   echo  "     <tr>"
                                        . "             <td>  metodo rellenar array  </td>"
                                        . "             <td> $this->contadorAgenda </td>"
                                        . "     </tr>";
                                
                                echo  "</table>"
                                        . "</div>"; 
                     }else{
                        echo "Agenda sin contactos" ;
                     }
                }
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

               public function eliminarContacto($nombre ) {
                   unset($this->array_asociativo[$nombre]);//elimino del array asociativo que tiene la [clave] 
               }
               
               public function modificarTelefono($nombre ,$telefono) {
                   $remplazos=array();
                   $base = array(); 
                      $base[]= $this->array_asociativo;
                      $remplazos[$nombre]=$telefono;
                      $this->array_asociativo = array_replace($base, $remplazos); // el array es el resutoado de superponer los valores de $remplazos en $base
                    
               }
}
