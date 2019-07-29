<?php

//MIXATRÓN

function conectarABBDD(){
            $ip = 'formacio.obsea.es';
            $usuari = 'marcel';
            $password = 'mrodrigo';
            $db_name = 'marcel';

            // connectem amb la db
            $con = mysqli_connect($ip,$usuari,$password,$db_name, 13308);
            if (!$con)  {
                   echo "Ha fallat la connexió a MySQL: " . mysqli_connect_errno();
                   echo "Ha fallat la connexió a MySQL: " . mysqli_connect_error();
            }
            return $con;
    }
    
        function validaFichero($fichero){
                $resultado = null;
                $tmp_name = $fichero['tmp_name'];
                $error = $fichero['error'];
                $size = $fichero['size'];
                $max_size = 1024 * 1024 * 9;
                $extension = $fichero['type'];
                
                if($error){
                    $resultado = "Ha ocurrido un error al subir el fichero ".$error;
                }elseif($size > $max_size){
                    $resultado = "El tamaño subera el máximo permitido: 9mb";
                }else if($extension != 'audio/mp3' ){
                    $resultado = 'Sólo se permiten archivos mp3';
                }
                return $resultado;
    }