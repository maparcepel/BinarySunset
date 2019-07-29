<?php
        session_start();

        require("funciones.php");
        
        if(isset($_SESSION["login"]) && $_SESSION["login"] = true){
               $usuario =  $_SESSION["usuario"];
        }elseif(isset($_COOKIE["usuario"]) && $_isset(COOKIE["password"])){
            validaCookie($_COOKIE["usuario"], $_COOKIE["password"]);
        }else{
            header('Location: login.php');
        }

?>

<html id="projectes_admin">
    <head>
        <title>Projectes</title>
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
        <div class="container-fluid">
            <div class="row pb-5 pt-5 ">
                <div class="col-6 text-center" >
                    <img class="img-fluid header_mix" src="img/logo_mixatron.png" alt="Logo Mixatron">
                </div>
                <div class="col-6 text-center">
                     <img class="img-fluid header_mix" src="img/logo2.png" alt="Logo Binary Sunset">
                </div>
            </div>
            <div class="row" >
                <div id="logout" class="col-12 text-right ">
                    <a href="cerrar_sesion.php">LOGOUT</a>
                </div>
            </div>
        </div>
            
            <section class="container" >

                <div class="row ">
                    <div class="col mt-5 d-flex justify-content-center">
                        <div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
                        <h5 class="naranja mb-3">Projectes:</h5>
                          <!-- Accordion card cambiar collapse1x3 y heading1x2-->  
                    </div>   
                </div>
                <div id="respuesta" class="col-12 mt-2 text-center naranja">
                       <p>El proyecto ya existe!</p>
                </div>
            </section>

        
        
        
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="js/proyectos_admin.js"></script>
    </body>
</html>
