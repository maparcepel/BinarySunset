 <?php
        session_start();
        $error="";
        require("funciones.php");
        
//REVISA TOKEN
        if(isset($_GET['token'])){
            $token=$_GET['token'];
        }else{
             header('Location: login.php'); 
        }
        $con = conectarABBDD();
        $sql="SELECT * FROM Tokens WHERE token='" . $token . "'";
        $resultat= mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
        $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
       
        if($resultat->num_rows != 1){
            $error="Hay un error consulta con el administrador de la base de datos";
            mysqli_close($con);  
        }
        
        
        if(isset($_REQUEST["submit"])){
           if($_POST["pass1"] ==$_POST["pass2"] ){
                $usuario=$registre['grupo'];
                $sql="UPDATE Proyectos SET password='".md5($_REQUEST['pass1'])."' WHERE grupo='$usuario'";
                $resultat= mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
               
               mysqli_close($con);  
                header('Location: cambio_pass_2.php'); 
           }else{
               $error="Las 2 contraseñas deben ser iguales";
           }
         }

    ?>

<html id="login">
    <head>
        <title>Cambio de contraseña</title>
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

                        <div id="texto" class="d-flex justify-content-center pt-4" >
  
                            <form  action='' method='POST'>
                                <p>Escribe tu nueva contraseña</p>
                                <input type='password' name='pass1'><br><br>
                                <p>Escribe otra vez la contraseña</p>
                                <input type='password' name='pass2'><span><?=$error?></span><br><br>
                                <input class="btn btn-outline-dark" type='submit' name='submit' value='Acceder'><br>

                            </form><br>
                        </div>
                        
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
