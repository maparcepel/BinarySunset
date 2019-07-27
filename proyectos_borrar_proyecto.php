<?php
    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
    if (isset($_POST['proyecto_a_borrar']) && !empty($_POST['proyecto_a_borrar'])){  
        $proyecto = htmlspecialchars($_POST['proyecto_a_borrar'],ENT_QUOTES);
        
        $con = conectarABBDD();
 //COMPRUEBA SI YA EXISTE EL PROYECTO       
        $sql = 'DELETE FROM Proyectos WHERE  grupo = "'. $proyecto . '"';
        $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));

        echo json_encode('borradom' . $proyecto);     
        mysqli_close($con);

                    
    }