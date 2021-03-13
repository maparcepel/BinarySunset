 <?php
        session_start();
//        usuario:admin - pass:1234
//        usuario:Celestial Bums - pass:1234
        $error='';
        require("funciones.php");
        if(isset($_POST["submit"])){
            $error=comprueba_password ($_POST["usuario"], md5($_POST["password"]), $_POST["recordar"]);
        }    

//REVISO SI HAY SESION O COOKIE PARA REDIRECCIONAR
        if(isset($_SESSION["login"]) && $_SESSION["login"] = true){
               validaSesion();
        }elseif(isset($_COOKIE["usuario"]) && $_isset(COOKIE["password"])){
            validaCookie($_COOKIE["usuario"], $_COOKIE["password"]);
        }
    ?>

<html id="login">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="shortcut icon"  href="img/favicon.ico">
        <link  href="http://binarysunsetestudio.com/img/iconomicro.jpg"  rel="image_src">
        <meta  property="og:image"  content="http://binarysunsetestudio.com/img/iconomicro.jpg">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/estilo.css">

    </head>
    <body>
        <div class="container">
            <div class="row mb-5">
                <div class="col-6 d-flex flex-wrap aligh-content-end" id="menu"></div>
                <div class="col-6   ">
                     <img class="img-fluid float-right mt-2 mb-2 mr-2" src="img/logo2.png" alt="Logo Binary Sunset">
                </div>
 
            </div>
            <section >
                <div class="row">
                    <div class="col-sm-12 col-md-6 mt-5 mb-5 text-center img ">
                        <img id="logo_mixatron"  src="img/logo_mixatron.png" alt="Logo Mixatron">
                        <h6 class="font-italic mt-2 ">Una herramienta para optimizar</h6>
                        <h6 class="font-italic mb-5">el feedback entre músicos y técnico de sonido</h6>
                        
                        <h6 class="mt-5 text-info font-weight-bold">Instrucciones para usuarios invitados (instrucciones no visibles en la instalación oficial de la web):</h6>
                        
                        <p class="text-info">Mixatrón establece un marco bien estructurado para el intercambio de información entre técnico y músico durante el proceso de mezcla. </p>
                        <p class="text-info">Las canciones que hay en este momento se repiten porque han sido subidas para pruebas y no están completas por la limitación de 2 mb de este servidor. Puedes subir libremente ficheros mp3 siempre que no superen este límite. </p>
                        <h6 class="text-info font-weight-bold">----PERFIL TÉCNICO DE SONIDO----</h6>
                        <h6 class="text-info font-weight-bold">Usuario: admin - password: 1234</h6>
                        <p class="text-info">Al entrar como usuario "técnico de sonido" se pueden ver todos los proyectos (grupos) y canciones en que estamos trabajando, 
                            agregar proyectos y/o canciones a la base de datos, escuchar y ver el audio de una cancion, ver comentarios que ha dejado el grupo y subir un nuevo mp3 a partir de esos comentarios.</p>
                        <h6 class="text-info font-weight-bold">----PERFIL MÚSICO----</h6>
                        <h6 class="text-info font-weight-bold">Usuario: Celestial Bums - password: 1234</h6>
                        <p class="text-info">El usuario "músico" puede ver las canciones que ha subido para él el técnico, puede escucharlas y poner comentarios sobre el audio con instrucciones para que el técnico reaLice una nueva mezcla.</p>
                    </div>
                    
                    <div class="col-sm-12 col-md-6 mt-5">
                        <div>

                        </div>
                        <span id="respuesta"></span>
                        <form  method="post"  class="pr-4 pl-4">
                            <div class="form-group">
                                <label for="idusuario">Usuario<span class="rojo">*</span><span id="error_usuario"></span></label>
                                <input type="text" class="form-control form-control-sm " id="idusuario" name="usuario" data-rule="required" data-msg=" Escribe tu usuario">
                            </div>
                            <div class="form-group">
                                <label for="idpassword">Contraseña<span class="rojo">*</span><span id="error_password"></span></label>
                                <input type="password" class="form-control form-control-sm" id="idpassword" name="password" data-rule="required" data-msg=' Escribe tu contraseña'>
                            </div>
                            <div class="form-group">
                                <label for="idrecordar"></label>
                                <input type='checkbox' name='recordar' id="idrecordar"> <span>Recuérdame en este equipo</span>
                            </div>
                            <div class="form-group">
                                <label for="idboton"></label>
                                <input type="submit" class="form-control form-control-sm bgnaranja colortextos w-25 mb-2" id="idboton" name="submit"><span class="rojo"><?=$error?></span>
                            </div>
                            <a href="recuperar_contra.php">He olvidado mi contraseña</a>



                        </form>
                    </div>
                    
                </div>
            </section>
        </div>
        
        
        
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="js/agregamenu.js"></script>
    </body>
</html>
