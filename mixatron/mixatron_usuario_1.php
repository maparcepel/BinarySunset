<?php
    require("../funciones.php");
    if(isset($_GET['proyecto']) && !empty($_GET['cancion'])){   
        $proyecto = htmlspecialchars($_GET['nuevo_proyecto'],ENT_QUOTES);
        $cancion = htmlspecialchars($_GET['cancion'],ENT_QUOTES);
        $con = conectarABBDD();
        //UBICACION DE LA CANCION A CARGAR EN APP.JS
        $sql = "SELECT ubicacion FROM Canciones WHERE grupo = '" . $proyecto . "' && nombreCancion = '" . $cancion . "' ";
        $resultat = mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
        $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
        $ubicacionCancion = $registre['ubicacion'];
        //VARIABLES PARA ENVIAR COMENTARIOS A BD DESDE APP.JS
        echo"<script>var proyecto='" . $proyecto . "'</script>";
        echo"<script>var cancion='" . $cancion . "'</script>";
        echo"<script>var ubicacionCancion='" . $ubicacionCancion . "'</script>";

        //COMENTARIOS PARA CARGAR SOBRE EL AUDIO
        $sql = "SELECT idComentario, inicio, fin, comentario FROM Comentarios WHERE nomCancion = '" . $cancion . "'";
        $resultat = mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
        $num_filas = $resultat->num_rows;
        $i = 1;
        $array_json_regiones  =  '[';

        while($registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){

                    $array_json_regiones  .=  '{ 
                        "attributes": { "label": "' . $registre['idComentario'] . '", "highlight": true },
                        "start": "' . $registre['inicio'] . '",
                        "end": "' . $registre['fin'] . '",
                        "data": { "note": "' . $registre['comentario'] . '" }}';
                if($i < $num_filas){
                    $array_json_regiones  .=  ','  ; 
                }
                $i++;
            }
        $array_json_regiones  .=  ']'  ;   
    //    echo $array_json_regiones;
        echo "<script>var json_regiones = " . $array_json_regiones . "</script>";    
        mysqli_close($con); 
    }
 ?>

<html id="projectes_admin2">
    <head>
        <title>MIXATRON</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link  rel="shortcut icon"  href="../img/favicon.ico">
        <link  href="http://binarysunsetestudio.com/img/iconomicro.jpg"  rel="image_src">
        <meta  property="og:image"  content="http://binarysunsetestudio.com/img/iconomicro.jpg">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pathway+Gothic+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/estilo.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        
        <div class="container-fluid mb-3">

            <div class="row pb-3 pt-3 ">
                <div class="col-6 text-center" >
                    <img class="img-fluid header_mix" src="../img/logo_mixatron.png" alt="Logo Mixatron">
                </div>
                <div class="col-6 text-center">
                     <img class="img-fluid header_mix" src="../img/logo2.png" alt="Logo Binary Sunset">
                </div>
            </div>
        </div>
         <div class="container">

             <h5 class="naranja"><?=$proyecto . " - " . $cancion?></h5>
            <?php

                include('player_usuario.html');
            ?>
            <p id="respuesta"></p>
         </div>
         
    </body>
</html>