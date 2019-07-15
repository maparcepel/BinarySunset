<?php
    require("../funciones.php");
    
    $proyecto = 'Pink Floyd';
    $cancion = 'Echoes';
    $nomMix = 'mix1';
    $con = conectarABBDD();
    $sql = "SELECT ubicacion FROM mixes m INNER JOIN canciones c ON m.nomCancion = c.nomCancion WHERE c.grupo = 'Pink Floyd'";
    $resultat = mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
    $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
    print_r($registre);
    
        
?>

<html>
    <head>
        <title>MIXATRON</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
        <div>MIXATRON</div>
        
         
        <?php
            include('player.html');
        ?>
        <p id="respuesta"></p>
        
         
    </body>
</html>
