<?php
    require("funciones.php");
    require("email/funcionesEmail.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
    if (isset($_POST['nuevo_proyecto']) && !empty($_POST['nuevo_proyecto'])){  
        $proyecto = htmlspecialchars($_POST['nuevo_proyecto'],ENT_QUOTES);
        $email = htmlspecialchars($_POST['nuevo_proyecto_email'],ENT_QUOTES);
        $con = conectarABBDD();
 //COMPRUEBA SI YA EXISTE EL PROYECTO       
        $sql = 'SELECT grupo FROM Proyectos WHERE grupo = "'. $proyecto . '"';
        $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
        $filas1 = mysqli_num_rows($resultat);
//COMPRUEBA SI YA EXISTE EL EMAIL       
        $sql2 = 'SELECT email FROM Proyectos WHERE email = "' . $email . '"' ;
        $resultat2 = mysqli_query($con,$sql2) or die('Consulta fallida: ' . mysqli_error($con));
        $filas2 = mysqli_num_rows($resultat2);
        if ($filas1> 0){
            $respuesta = 'El proyecto ya existe!';
        }else if($filas2 > 0){
            $respuesta = 'Este email ya existe!';
        }else{
        
            $sql = 'INSERT INTO Proyectos (grupo, email) VALUES ("'. $proyecto . '", "'. $email . '")';
            mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con)); 

            $respuesta = 'ok';
            
                //CREA TOKEN
            $token=md5(rand(111111,99999999));
            $sql="INSERT INTO Tokens (token, grupo) VALUES ('$token', '$proyecto')";
            mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
            $link = "http://localhost:8888/BinarySunset/cambio_pass.php?token=$token"  ;
            invitacion_registro($email, $link ,$proyecto);
        }
                    
        
        mysqli_close($con);
        echo json_encode($respuesta);     
        

                    
    }
    ?>