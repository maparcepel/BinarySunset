<?php
    require("../funciones.php");
    
    $con = conectarABBDD();
    $sql = "SELECT email FROM proyectos WHERE grupo='pink fl'";
    
    
        
?>

<html>
    <head>
        <title>MIXATRON</title>
        <meta http-equiv =»Cache-Control» content =»no-store»/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>MIXATRON</div>
        
         
        <?php
            include('player.html');
        ?>
        
    </body>
</html>
