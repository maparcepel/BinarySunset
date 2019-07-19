<?php
    require("../funciones.php");
    header('Access-Control-Allow-Origin: *');
    if (isset($_POST['inicio']) && !empty($_POST['inicio'])
	&& isset($_POST['fin']) && !empty($_POST['fin'])) {
//	$datos = Array();
              $cancion = htmlspecialchars($_POST['cancion'],ENT_QUOTES);
              
	$inicio = htmlspecialchars($_POST['inicio'],ENT_QUOTES);
              $inicio_array = explode(":", $inicio);
              $inicio = ($inicio_array[0] * 60) + $inicio_array[1];
              
	$fin = htmlspecialchars($_POST['fin'],ENT_QUOTES);
              $fin_array = explode(":", $fin);
              $fin = ($fin_array[0] * 60) + $fin_array[1];
               $comentario = htmlspecialchars($_POST['comentario'],ENT_QUOTES);
               $idcomentario = htmlspecialchars($_POST['idcomentario'],ENT_QUOTES);

                $con = conectarABBDD();
//SI EXISTE ESTE COMENTARIO SE EDITA EN LUGAR DE AGREGAR NUEVO                
                $sql = 'SELECT idcomentario FROM Comentarios WHERE idcomentario = "' . $idcomentario . '" ';
                $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
                if(mysqli_num_rows($resultat) > 0){
                    $sql = 'UPDATE Comentarios SET comentario = "' . $comentario . '", inicio = "' . $inicio . '", fin =  "' . $fin . '" WHERE idcomentario = "' . $idcomentario . '" '  ;
                }else{
                    $sql = 'INSERT INTO Comentarios VALUES  (null, "' . $cancion . '", "' . $comentario . '", "' . $inicio . '", "' . $fin . '", "")';
                }
                $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
                
                mysqli_close($con);
                
                echo json_encode("[status:ok]");
}
?>