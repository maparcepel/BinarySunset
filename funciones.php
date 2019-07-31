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
                $max_size = 1024 * 1024 * 2;
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

         //DEVUELVE ARRAY CON LINK CON TOKEN Y EL USUARIO AL QUE CORRESPONDE
 //SI NO EXISTE UN USUARIO CON ESTE EMAIL DEVOLVERA MENSAJE ERROR   
    function generaEnlaceContrasena($email){
        $link='';
        $token=md5(rand(111111,99999999));
        
        $con = conectarABBDD();
        $sql="SELECT grupo FROM Proyectos WHERE email='" . $email . "'";
        $resultat= mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
        $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
        $usuario=$registre['grupo'];
        
        $sql="SELECT grupo FROM Tokens WHERE grupo='" . $usuario . "'";
        $resultat= mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
        $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
        $usuario_token=$registre['grupo'];
        
        if($usuario==null){
            $link="error";
        }else if($usuario_token==null){
//SI NO EXISTE ESTE USUARIO EN TOKENS CREA UNA FILA            
            $sql="INSERT INTO Tokens (token, grupo) VALUES ('$token', '$usuario')";
            mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
            $link = "http://formacio.obsea.es:8081/CFO2018/marcelrodrigo/cambio_pass.php?token=$token"  ;
        }else{
//SI  EXISTE EL USUARIO EN TOKENS ACTUALIZA LA FILA FILA            
            $sql="UPDATE Tokens SET token= '$token' WHERE grupo= '$usuario'";
            mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
            $link = "http://formacio.obsea.es:8081/CFO2018/marcelrodrigo/cambio_pass.php?token=$token"  ;
        }
        mysqli_close($con);  
        return $array=array('link'=>$link, 'usuario'=>$usuario);
    }