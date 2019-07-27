<?php
    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
    if (isset($_POST['nuevo_proyecto']) && !empty($_POST['nuevo_proyecto'])){  
        $proyecto = htmlspecialchars($_POST['nuevo_proyecto'],ENT_QUOTES);
        $con = conectarABBDD();
 //COMPRUEBA SI YA EXISTE EL PROYECTO       
        $sql = 'SELECT * FROM Proyectos WHERE grupo = "'. $proyecto . '"';
        $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
//        $registre2 = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
        if (mysqli_num_rows($resultat) > 0){
            $respuesta = 'El proyecto ya existe!';
        }else{
            $sql = 'INSERT INTO Proyectos (grupo) VALUES ("'. $proyecto . '")';
            mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con)); 
            $respuesta = 'ok';
        }
                    
        

        echo json_encode($respuesta);     
        mysqli_close($con);

                    
    }