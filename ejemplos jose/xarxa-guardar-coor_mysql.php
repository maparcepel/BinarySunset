<?php 
                  $arrayPHP[] = Array();
                  $arrayPHP = $_POST["array_mesas"];
                  require("xarxa-conexion-mysql.php");
                 foreach ($arrayPHP as $key => $value) {
                     $name =$value['name'];
                        $x =$value['x'];
                        $y =$value['y'];

                        echo $name." ".$x." ".$y."<br>";
                  
                   /*  $sql_update = "UPDATE comedor
                                       SET mesa='".$name."',
                                             cx='".$x."', 
                                             cy='".$y."'
                                     WHERE mesa='".$name."' ";
                     $resultat_update = mysqli_query($con, $sql_update) or die('Modificacion fallida: '.mysqli_error($con)); */  
                  }
                //  print_r($_POST["array_mesas"]);
                  mysqli_close($con);
?>