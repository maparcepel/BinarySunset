<?php
    require("funciones.php");
    //Seteamos el header de "content-type" como "JSON" para que jQuery lo reconozca como tal
    header('Content-Type: application/json');
   

//                    $con = conectarABBDD();
//                    $sql = 'SELECT grupo, nombreCancion FROM marcel.Canciones order by grupo ';
//                    $resultat = mysqli_query($con,$sql) or die('Consulta fallida: ' . mysqli_error($con));
//                    
//                    while ($registre = mysqli_fetch_array($resultat, MYSQLI_ASSOC)) {
//                        foreach($registre as $clave=>$col_value) {
//                            
//                                echo $clave;
//                            
//                                echo $col_value . "<br>";
//                            
//                        }
//
//                        
//                    }
                         $proyectos =  [  
         ['Low Blows', 'Skin', 'On the road', 'Resignation'],
         ['Violet Mistake', 'Seiryü', 'Dimension'],
         ['Celestial Bums', 'Number one', 'Martir', 'Ace', 'Sabotage'],
         ['Wavelet', 'Viento sur', 'Esas fuerzas', 'Surfera']
     ];
                    echo json_encode($proyectos);     
                    mysqli_close($con);

                    
  