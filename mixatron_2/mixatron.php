<?php
    require("../funciones.php");
    
    $proyecto = 'Pink Floyd';
    $cancion = 'Echoes-mix1';
    $con = conectarABBDD();
    //UBICACION DE LA CANCION A CARGAR EN APP.JS
    $sql = "SELECT ubicacion FROM Canciones WHERE grupo = '" . $proyecto . "' && nombreCancion = '" . $cancion . "' ";
    $resultat = mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
    $registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
    $ubicacionCancion = $registre['ubicacion'];
    //VARIABLES PARA ENVIAR COMENTARIOS A BD DESDE APP.JS
    echo"<script>var proyecto='" . $proyecto . "'</script>";
    echo"<script>var cancion='" . $cancion . "'</script>";
    echo"<script>var ubicacionCancion='../" . $ubicacionCancion . "'</script>";
    
    //COMENTARIOS PARA CARGAR SOBRE EL AUDIO
    $sql = "SELECT inicio, fin, comentario FROM Comentarios WHERE nomCancion = '" . $cancion . "'";
    $resultat = mysqli_query($con,$sql) or die("Consulta fallida:" . mysqli_error($con));
    $num_filas = $resultat->num_rows;
    $i = 1;
    $array_json_regiones  =  '[';
    
    while($registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC)){
            
                $array_json_regiones  .=  '{ 
                    "start": "' . $registre['inicio'] . '",
                    "end": "' . $registre['fin'] . '",
                    "data": { "note": "' . $registre['comentario'] . '" }}';
            if($i < $num_filas){
                $array_json_regiones  .=  ','  ; 
            }
            $i++;
        }
    $array_json_regiones  .=  ']'  ;   
    echo $array_json_regiones;
    echo "<script>var json_regiones = " . $array_json_regiones . "</script>";    

    mysqli_close($con); 
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
