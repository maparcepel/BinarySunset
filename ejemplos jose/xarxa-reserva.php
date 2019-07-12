<?php 
  require("php/xarxa-validacion-menus_mysql.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reserva - facefrog - UF3</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css\css-xarxa-php.css" rel="stylesheet" type="text/css"/>
  <link href="css\css-menu.css" rel="stylesheet" type="text/css"/>
  <link href="css\css-xarxa-lienzo.css" rel="stylesheet" type="text/css"/>  
</head>
<body>

<!-- Menu principal -->
<div class="menu-principal">
    <nav class="navbar navbar-inverse">
     <div class="container-fluid">
       <div class="navbar-header">
         <scan id="rdr" class="navbar-brand">RDR</scan>
       </div>
       <div class="collapse navbar-collapse" id="myNavbar">
         <ul class="nav navbar-nav">
           <li><a href="xarxa-inicio_mysql.php">Inicio</a></li>
           <li><a href="xarxa-alta_mysql.php">Alta</a></li>
           <li><a href="xarxa-consulta_mysql.php">Consulta</a></li>
           <li><a href="CRUD_mysql.php">CRUD</a></li>           
           <li><a href="Mailing_mysql.php">Mailing</a></li>
           <li><a href="Xarxa-whatsapp.php">Whatsapp</a></li>                      
           <li><a href="dompdf_mysql.php">PDF</a></li>
           <li class="active"><a href="xarxa-reserva.php">Reserva</a></li>           
         </ul>
         <ul class="nav navbar-nav navbar-right">
           <li><a href="CRUD_mysql.php?logout"><span class="glyphicon glyphicon-lock"></span>logout</a></li>           
         </ul>
       </div>
     </div>
    </nav> 
</div>

<header id="cabecera">
  <h1>Red de Ranas</h1> 
  <span>Usuario: <?php require("php/xarxa-nombre_mysql.php");?></span>
</header>


<!-- Funciona con datos estandar, hay que validar contenidos-consulta y container -->
<!-- Todas las publicaciones -->
<!--<div id="contenidos-consulta"> -->
<!--   <div class="container">  --> 
<!--<div style="position:relative;">-->
<!--  <div id='d1' style="position:absolute; top:200px; left:20px; z-index:-1;"> -->
    <canvas id="lienzo" width="1000px" height="500px"></canvas>      
<!--  </div> -->
<!--</div>-->
<!-- SE RECUPERAN DATOS DE BBDD, generando un Array. -->
    <?php


       $mesas_array = Array();
       $mesa = "";
       $coor_x = $coor_y = 0;


       require("php/xarxa-conexion-mysql.php");
       $sql = "SELECT * FROM comedor";
       $resultat = mysqli_query($con, $sql) or die('Consulta Inicial fallida: '.mysqli_error($con));

       while ($row=mysqli_fetch_object($resultat)){
              $mesas_array[] = Array(
                   "mesa"   =>$row->mesa,
                   "coor_x" =>$row->cx,
                   "coor_y" =>$row->cy );
       }       
    ?>


      <script>
        //objetos: objeto relacionado con los objeto con movimiento dentro del canvas.
        var cv, cx, objetos, objetoActual = null;
        var inicioX, inicioY = 0;
        //Actualizar cada uno de los objetos, color, entorno y posicion dentro del canvas.
        //r=red, g=green, b=blue, a=opacidad (0min. y 1max.)
        function actualizar (){
          //filStyle = color, fillRect = forma, strokeRect = contorno, clearRect = crea transparencia (permite ver imagen de fondo).
          //cx.fillStyle ="rgba(200,200,200, 1)";
          //cx.fillRect(5,5, 990, 490);
          cx.strokeRect(5, 5, 990, 490);
          cx.clearRect(0,0, 1000,500);
          for (var i=0; i<objetos.length; i++){
              cx.fillStyle = objetos[i].color;
              cx.fillRect(objetos[i].x, objetos[i].y, objetos[i].width, objetos[i].height);
              cx.fillStyle = "black";              
              cx.fillText(objetos[i].name, objetos[i].x+8, objetos[i].y+15);
              cx.fillText("x: ", objetos[i].x+8, objetos[i].y+30);
              cx.fillText(objetos[i].x, objetos[i].x+25, objetos[i].y+30);
              cx.fillText("y: ", objetos[i].x+8, objetos[i].y+45);
              cx.fillText(objetos[i].y, objetos[i].x+25, objetos[i].y+45);

          }
        }

        window.onload = function(){
           //Obtenemos el array de valores mediante la conversion a json del array de php.
           //var arrayJS=<?php //echo json_encode($mesas_array);?>;
           objetos = [];
           cv = document.getElementById('lienzo');
           cx = cv.getContext('2d');
           cx.font = "14px Georgia";


           <?php for ($i = 0; $i<count($mesas_array); $i++){ ?>
              var x_ =  <?= $mesas_array[$i]['coor_x']?>;
              var y_ =  <?= $mesas_array[$i]['coor_y']?>;
              var mesa =  <?= "'".$mesas_array[$i]['mesa']."'"?>;
              //Objeto mesa.
              objetos.push({
                 x: x_, y: y_,
                 width: 60, height: 60,
                 color: 'brown',
                 name: mesa               

              });
           <?php }?>

           actualizar();
           
           cv.onmousedown = function(event){
              for (var i=0; i<objetos.length; i++){
                 if (objetos[i].x < event.clientX 
                 && (objetos[i].width + objetos[i].x > event.clientX)
                 && objetos[i].y < event.clientY 
                 && (objetos[i].height + objetos[i].y > event.clientY)){
                 objetoActual = objetos[i];
                 inicioY = event.clientY - objetos[i].y;
                 inicioX = event.clientX - objetos[i].x;
                 break;
                 }
              }
           };
           
           cv.onmousemove = function(event){
              if(objetoActual != null){
                 objetoActual.x = event.clientX - inicioX;
                 objetoActual.y = event.clientY - inicioY;
                 actualizar();
              }
           };
  
           cv.onmouseup = function(event){
              objetoActual = null;
           }

          //Para pasar los valores de JavaScript(Cliente) (tabla: objetos) a BBDD(Servidor) usamos //AJAX.
          //Boton (formulario): #guardar --> cuando se hace click usamos la funcion() 
          //Se envia mediante type: "POST", a la pagina definida en url:, data: pasamos js(tabla:objetos a //ajax:arraymesa), success: mensaje del resultado de la accion. 
           $("#guardar").click(function(){
              $.ajax({
                type: "POST",
                url: "php/xarxa-guardar-coor_mysql.php",
                data:{ array_mesas: objetos },
                success: function(msg){
                   alert(msg);
                }
              });
           });


        };
      </script>

  <h3>Coordenadas Plano</h3>
<!-- Pagina publica de entrada usuario y contraseÃ±a -->   
   <fieldset>
     <legend>Guardar Plano</legend>
     <form  method="post" action="xarxa-guardar-coor_mysql.php?">
     <input type="button" name="Guardar" id="guardar" value="Guardar"> 
     </form> 
   </fieldset>     


<?php require("php/pie_de_pagina_mysql.php"); ?>
</body>
</html>