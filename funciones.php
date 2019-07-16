<?php

//MIXATRÓN

function conectarABBDD(){
            $ip = 'localhost';
            $usuari = 'marcel';
            $password = 'marcel';
            $db_name = 'marcel';

            // connectem amb la db
            $con = mysqli_connect($ip,$usuari,$password,$db_name);
            if (!$con)  {
                   echo "Ha fallat la connexió a MySQL: " . mysqli_connect_errno();
                   echo "Ha fallat la connexió a MySQL: " . mysqli_connect_error();
            }
            return $con;
    }
    