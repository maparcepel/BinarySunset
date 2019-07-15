<?php
    require("../funciones.php");

    header('Access-Control-Allow-Origin: *');
    if (isset($_POST['inicio']) && !empty($_POST['inicio'])
	&& isset($_POST['fin']) && !empty($_POST['fin'])) {
	$datos = Array();
	$inicio = htmlspecialchars($_POST['inicio'],ENT_QUOTES);
	$fin = htmlspecialchars($_POST['fin'],ENT_QUOTES);
                $comentario = htmlspecialchars($_POST['comentario'],ENT_QUOTES);
	$datos['inicio'] = $inicio;
	$datos['fin'] = $fin;
	$datos['comentario'] = $comentario;
        
              
                
                $con = conectarABBDD();
                $sql = 'INSERT INTO marcel.Comentarios (comentario, inicio, fin) VALUES  ("' . $comentario . '", "' . $inicio . '", "' . $fin . '")';
                $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
                
                mysqli_close($con);
}


?>