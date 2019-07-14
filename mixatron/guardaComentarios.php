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
//                echo json_encode($datos);
}
//    foreach($_POST as $post_var){
//        echo strtoupper($post_var) . "<br />";
//    }
    
    
//                  $arrayPHP[] = Array();
//                  $arrayPHP = $_POST["comentario"];
//                  print_r($arrayPHP);
//                  require("xarxa-conexion-mysql.php");
//                 foreach ($arrayPHP as $key => $value) {
//                     $name =$value['start'];
//                        $x =$value['end'];
//                        $y =$value['note'];

//                        echo $name." ".$x." ".$y."okk <br>";
                  
                   /*  $sql_update = "UPDATE comedor
                                       SET mesa='".$name."',
                                             cx='".$x."', 
                                             cy='".$y."'
                                     WHERE mesa='".$name."' ";
                     $resultat_update = mysqli_query($con, $sql_update) or die('Modificacion fallida: '.mysqli_error($con)); */  
//                  }
                //  print_r($_POST["array_mesas"]);
//                  mysqli_close($con);
?>