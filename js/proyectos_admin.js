 $(document).ready(function(){
        acordeon = $('.accordion');
        
        $.ajax({
            url: 'proyectos_admin_consulta.php',
            type: 'post',
            data: { "proyectos": "x"},
            success: function(proyectos) {
                console.log(proyectos);
               var i = 0; 
            $.each(proyectos, function() {
                
                    item = '<div class="card"><div class="card-header" role="tab" id="heading' + i + '">';         
                    item += '<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse' + i + '"aria-expanded="false" aria-controls="collapse' + i + '">';         
     //INSERTA BOTON BORRAR PROYECTO               
                     item += '<h5 class="mb-0 d-inline">' + proyectos[i][0] + ' <i class="fas fa-angle-down rotate-icon"></i></h5></a><a href="" class="borra_proyecto float-right" data-proyecto="' + proyectos[i][0] + '" title="Borrar proyecto"><img src="img/boton_borrar.png"></a></div>';         
                    item += '<div id="collapse' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading' + i + '"data-parent="#accordionEx1"><div class="card-body pb-0 pr-0">';         

      //INSERTA CANCIONES              
                     for(var j = 1; j < proyectos[i].length; j++){
                       item += '<p><a href="mixatron/mixatron_admin.php?proyecto=' + proyectos[i][0]  + '&cancion=' + proyectos[i][j] + '">' + proyectos[i][j] + '</a></p>'; 
                    }
     //INSERTA BOTON PARA AGREGAR CANCION
                     item += '<p ><a   id="agregar_cancion_' + i + '" href=""  data-proyecto="' + proyectos[i][0] + '"><img  src="img/boton_agregar.png" alt="Agregar nueva canción"></a>'
      //INSERTA INPUT NUEVA CANCION              
                     item += '<span id="input_cancion_' + i + '" class="d-none" ><input class="form-control form-control-sm w-75 mr-0 d-inline" type="text"  size="10"><a class="nueva_cancion" data-proyecto="' + proyectos[i][0] + '" href=""><img class="float-right"  src="img/boton_ir.png" alt="Agregar nueva canción"></a> </span></p>';
                     item += '</div></div></div>';
                     acordeon.append(item);        



     //COMPORTAMIENTO DEL BOTON PARA INSERTAR INPUT NUEVA CANCION
                     $('#agregar_cancion_' + i ).click(function(event){
                         event.preventDefault();
                         console.log($(this));

     //                    $(this).replaceWith();
     //                    $('#input_cancion_' + i );
                         $(this).hide();
                         $(this).next('span').removeClass('d-none');

                     });
                    i++;
               
             });
// INSERTA BOTON PARA AGREGAR PROYECTO
                boton1 = '<div><a  href="" id="agregar_proyecto"><img class="mt-3"  src="img/boton_agregar.png" alt="Agregar nuevo proyecto"></a></div>';
                acordeon.append(boton1); 
//ACCION DEL BOTON AGREGAR PROYECTO
                $('#agregar_proyecto').click(function(event){
                    event.preventDefault();
                    
//ENTRADA DE NUEVO PROYECTO
                    input_texto = $('<input id="nuevo_proyecto" class="form-control form-control-sm w-75 d-inline mt-2" type="text"  size="10"><a id="agregar_proyecto_2"href=""><img class="float-right mt-2"  src="img/boton_ir.png" alt="Agregar nuevo proyecto"></a> ');
                    $('#agregar_proyecto').replaceWith(input_texto.hide().fadeIn('slow'));
                    $('#agregar_proyecto_2').click(function(event){
                        event.preventDefault();
                        $nuevo_proyecto = $('#nuevo_proyecto').val();
 //ENVIA NOMBRE NUEVO PROYECTO                       
                        $.ajax({
                            url: 'proyectos_agregar_proyecto.php',
                            dataType: "json",
                            type: 'post',
                            data: { "nuevo_proyecto": $nuevo_proyecto},
                            success: function(respuesta) {
                                if (respuesta == 'ok'){
                                    window.location.href = 'proyectos_admin.php';
                                }else{
                                    
                                        $('#respuesta').find('p').css('display','block');  
                                    
                                    
                                }
                                
                           }
                       });
                    });

                });
     
            }
        });
//COMPORTAMIENTO DEL BOTON BORRA PROYECTO
        $(document).on("click", 'a.borra_proyecto', function(ev){
            ev.preventDefault();
//            console.log($(this).attr('data-proyecto'));
            $proyecto_a_borrar = $(this).attr('data-proyecto');
            if(confirm('Estás seguro')){
                $.ajax({
                            url: 'proyectos_borrar_proyecto.php',
                            dataType: "json",
                            type: 'post',
                            data: { "proyecto_a_borrar": $proyecto_a_borrar},
                            success: function(respuesta) {
//                                if (respuesta == 'ok'){
                                    window.location.href = 'proyectos_admin.php';
//                                }else{
//                                    
//                                        $('#respuesta').find('p').css('display','block');  
//                                    
//                                    
//                                }
                                
                           }
                       });
            }
                    
        }); 
 //COMPORTAMIENTO DEL BOTON INSERTAR NUEVA CANCION
        $(document).on("click", 'a.nueva_cancion', function(ev){
            ev.preventDefault();
            
            $proyecto_cancion = $(this).attr('data-proyecto');
//            console.log($proyecto_cancion);
            $nombre_cancion = $(this).prev().val();
//            console.log($nombre_cancion);
                $.ajax({
                            url: 'proyectos_agregar_cancion.php',
                            dataType: "json",
                            type: 'post',
                            data: { "proyecto": $proyecto_cancion,
                            "nueva_cancion": $nombre_cancion},
                            success: function(respuesta) {
                                console.log(respuesta);
                                if (respuesta == 'ok'){
                                    window.location.href = 'proyectos_admin.php';
                                }else{
                                    
                                        $('#respuesta').find('p').css('display','block');  
                                    
                                    
                                }
                                
                           }
                       });
            
                    
        });       
 });

