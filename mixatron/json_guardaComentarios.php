<?php
    require("../funciones.php");

    header('Access-Control-Allow-Origin: *');
    if (isset($_POST['inicio']) && !empty($_POST['inicio'])
	&& isset($_POST['fin']) && !empty($_POST['fin'])) {
//	$datos = Array();
              $cancion = htmlspecialchars($_POST['cancion'],ENT_QUOTES);
	$inicio = htmlspecialchars($_POST['inicio'],ENT_QUOTES);
	$fin = htmlspecialchars($_POST['fin'],ENT_QUOTES);
               $comentario = htmlspecialchars($_POST['comentario'],ENT_QUOTES);
//	$datos['inicio'] = $inicio;
//	$datos['fin'] = $fin;
//	$datos['comentario'] = $comentario;
        //    echo json_encode($datos);
              
                
                $con = conectarABBDD();
                $sql = 'INSERT INTO marcel.comentarios VALUES  (null, "' . $cancion . '", "' . $comentario . '", "' . $inicio . '", "' . $fin . '")';
                $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
                
                mysqli_close($con);
}


?>