<?php
    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
    
    $con = conectarABBDD();
    $sql = 'SELECT grupo FROM marcel.Proyectos ';
    $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
//crea un array bidimensional para enviar                    
    while ($registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
        unset($array);
        foreach($registre as $col_value) {
            $array[] = $col_value;
            $sql2 = 'SELECT nombreCancion FROM marcel.Canciones WHERE grupo = "' . $col_value . '"';
            $resultat2 = mysqli_query($con,$sql2) or die('Consulta fallida: ' . mysqli_error($con));

            while ($registre2 = mysqli_fetch_array($resultat2, MYSQLI_ASSOC)) {
                foreach($registre2 as $col_value2) {
                    $cancion = explode("-", $col_value2);
                    $cancion = $cancion[0];
                    if(!in_array($cancion, $array)){
                        $array[] = $cancion;
                    }
                }
            }                               
        }
        $array2[] = $array;
    }
    echo json_encode($array2);     
    mysqli_close($con);

                    
  