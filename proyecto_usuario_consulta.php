<?php

    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
   
    if (isset($_POST['grupo']) && !empty($_POST['grupo'])) {
       $array=[];
       $grupo = $_POST['grupo'];

       $con = conectarABBDD();
       $sql = 'SELECT nombreCancion FROM marcel.Canciones WHERE grupo = "' . $grupo . '"';
       $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));

       while ($registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
           foreach($registre as $col_value) {
               $cancion = explode('-', $col_value);
               $cancion = $cancion[0];
                if(!in_array($cancion, $array)){
                    $array[] = $cancion;
                }
           }             
       }
//       print_r($array);
       echo json_encode($array);        
       mysqli_close($con);   
    }
    

                    
  