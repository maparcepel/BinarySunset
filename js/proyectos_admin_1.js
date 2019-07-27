 $(document).ready(function(){
        acordeon = $('.accordion');
        
        $.ajax({
            url: 'proyectos_admin_consulta.php',
            type: 'post',
            data: { "proyectos": "x"},
            success: function(proyectos) {
               var i = 0; 
            $.each(proyectos, function() {
               
               item = '<div class="card"><div class="card-header" role="tab" id="heading' + i + '"><a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse' + i + '"aria-expanded="false" aria-controls="collapse' + i + '"><h5 class="mb-0">' + proyectos[i][0] + ' <i class="fas fa-angle-down rotate-icon"></i></h5></a></div><div id="collapse' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading' + i + '"data-parent="#accordionEx1"><div class="card-body pb-0">';         
 //INSERTA CANCIONES              
                for(var j = 1; j < proyectos[i].length; j++){
                  item += '<p><a href="mixatron/mixatron_admin.php?var proyecto=' + proyectos[i][0]  + '&var cancion=' + proyectos[i][j] + '">' + proyectos[i][j] + '</a></p>'; 
               }
//INSERTA BOTON PARA AGREGAR CANCION
                item += '<p ><a   id="agregar_cancion_' + i + '" href=""  data-proyecto="' + proyectos[i][0] + '"><img  src="img/boton_agregar.png" alt="Agregar nueva canción"></a></p>'
                item += '</div></div></div>';
                acordeon.append(item);          
//COMPORTAMIENTO DEL BOTON AGREGAR CANCION
                $('#agregar_cancion_' + i   ).click(function(event){
                    event.preventDefault();
//                    console.log($(this).attr('data-proyecto'));
//ENTRADA DE NUEVA CANCION
                    input_texto = $('<input class="form-control form-control-sm w-75 d-inline" type="text"  size="10"><a href=""><img class="ml-1"  src="img/boton_ir.png" alt="Agregar nueva canción"></a> ');
                    $(this).replaceWith(input_texto.hide().fadeIn('slow'));
                    
                    
                        console.log($(this));
                    
                    
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
                    input_texto = $('<input id="nuevo_proyecto" class="form-control form-control-sm w-75 mt-2 d-inline" type="text"  size="10"><a id="agregar_proyecto_2"href=""><img class="ml-3"  src="img/boton_ir.png" alt="Agregar nuevo proyecto"></a> ');
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
 });

