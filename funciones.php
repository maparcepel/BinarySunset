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
    