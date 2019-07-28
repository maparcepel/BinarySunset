<?php
    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
    if (isset($_POST['nueva_cancion']) && !empty($_POST['nueva_cancion'])){  
        $proyecto = htmlspecialchars($_POST['proyecto'],ENT_QUOTES);
        $nueva_cancion = htmlspecialchars($_POST['nueva_cancion'],ENT_QUOTES) . "-mix0";
        $con = conectarABBDD();
 //COMPRUEBA SI YA EXISTE EL PROYECTO       
        $sql = 'SELECT * FROM Canciones WHERE nombreCancion = "'. $nueva_cancion . '" && grupo = "'. $proyecto . '"';
        $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
//        $registre2 = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
        if (mysqli_num_rows($resultat) > 0){
            $respuesta = 'El proyecto ya existe!';
        }else{
            $sql = 'INSERT INTO Canciones (nombreCancion, grupo) VALUES ("'. $nueva_cancion . '", "'. $proyecto . '")';
            mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con)); 
            $sql = 'INSERT INTO Comentarios (nomCancion) VALUES ("'. $nueva_cancion . '")';
            mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con)); 
            $respuesta = 'ok';
        }
                    
        

        echo json_encode($respuesta);     
        mysqli_close($con);

                    
    }