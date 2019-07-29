<?php



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
 //VALIDA MP3   
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
 //COMPRUEBA PASSWORD   
        function comprueba_password($user, $contrasena, $recordar){
            $con = conectarABBDD();
            $sql = 'SELECT grupo, password FROM Proyectos WHERE grupo ="'. $user .'" AND password = "' . $contrasena . '" ' ;
            $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
            mysqli_close($con);
            if($resultat->num_rows == 1){
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["usuario"] = $user;
                if($recordar  == true){
                    setcookie("usuario" , $user , time()+365*24*60*60); 
                    setcookie("password" , md5($contrasena) , time()+365*24*60*60);
                }
                
                if($user == 'admin'){
                    header('Location: proyectos_admin.php');
                }else{
                    header('Location: proyecto_usuario.php');
                }
            }else{
               return "Usuario o contraseña incorrecta"; 
            } 
        }
        
 //VALIDA SESION       
        function validaSesion(){
            if($_SESSION["usuario"] == 'admin'){
                header('Location: proyectos_admin.php');
            }else{
                header('Location: proyecto_usuario.php');
            }
        }
 //VALIDA COOKIES
        function validaCookies($user, $password){
            $con = conectarABBDD();
            $sql = 'SELECT grupo, password FROM Proyectos WHERE grupo ="'. $user .'" AND password = "' . $password . '" ' ;
            $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
            mysqli_close($con);
            if($resultat->num_rows == 1){
                session_start();
                $_SESSION["login"] = true;
                $_SESSION["usuario"] = $user;
                
                if($user == 'admin'){
                    header('Location: proyectos_admin.php');
                }else{
                    header('Location: proyecto_usuario.php');
                }
            }
        }
