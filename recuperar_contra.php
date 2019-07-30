 <?php
        session_start();
        $error="";
        require("funciones.php");
        

        require("email/funcionesEmail.php");
//ENVIA NUEVA CONTRASEÑA

        if(isset($_POST["submit"])){
            $email = $_POST["email"];
            $array = generaEnlaceContrasena($email);
            if($array['link']=="error"){
                $error='No existe un usuario con este email';
            }else{
                enviaEnlacePass($email, $array['link'], $array['usuario']);
                header('Location: recuperar_contra_2.php');   
            }
            
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
                   
                    <div class="col mt-5 d-flex justify-content-center">

                            <form  action='' method='POST'>
                                <p>Escribe tu email para cambiar tu contraseña</p>
                                <input class=" form-control form-control-sm w-75" type='email' name='email'>
                                <input class="btn bgnaranja mt-3 colortextos" type='submit' name='submit' value='Enviar'><br><span class="rojo"><?=$error?></span>

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
