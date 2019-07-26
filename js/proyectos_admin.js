 $(document).ready(function(){
        acordeon = $('.accordion');
        var i = 0;
        $.ajax({
            url: 'proyectos_admin_consulta.php',
            type: 'post',
            data: { "proyectos": "x"},
            success: function(proyectos) {
                
            $.each(proyectos, function() {
               item = '<div class="card"><div class="card-header" role="tab" id="heading' + i + '"><a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse' + i + '"aria-expanded="false" aria-controls="collapse' + i + '"><h5 class="mb-0">' + proyectos[i][0] + ' <i class="fas fa-angle-down rotate-icon"></i></h5></a></div><div id="collapse' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading' + i + '"data-parent="#accordionEx1"><div class="card-body pb-0">';         
               for(var j = 1; j < proyectos[i].length; j++){
                  item += '<p><a href="mixatron/mixatron_admin.php?var proyecto=' + proyectos[i][0]  + '&var cancion=' + proyectos[i][j] + '">' + proyectos[i][j] + '</a></p>'; 
               }
//        INSERTA BOTON PARA AGREGAR CANCION
                item += '<p ><a   id="agregar_cancion_' + i + '" href=""  data-proyecto="' + proyectos[i][0] + '"><img  src="img/boton_agregar.png" alt="Agregar nueva canción"></a></p>'
                item += '</div></div></div>';
                acordeon.append(item);          
//ACCION DEL BOTON AGREGAR CANCION
                $('#agregar_cancion_' + i   ).click(function(event){
                    event.preventDefault();
                    console.log($(this).attr('data-proyecto'));
                });
               i++;
             });
 // INSERTA BOTON PARA AGREGAR PROYECTO
                boton1 = '<div><a  href="" id="agregar_proyecto"><img class="mt-3"  src="img/boton_agregar.png" alt="Agregar nuevo proyecto"></a></div>';
                acordeon.append(boton1); 
//ACCION DEL BOTON AGREGAR PROYECTO
                $('#agregar_proyecto').click(function(event){
                    event.preventDefault();
                    input_texto = $('<input id="nuevo_proyecto" class="form-control form-control-sm w-75 mt-2 d-inline" type="text"  size="10"><a href=""><img class="ml-3"  src="img/boton_ir.png" alt="Agregar nuevo proyecto"></a> ');
                    $('#agregar_proyecto').replaceWith(input_texto.hide().fadeIn('slow'));
                });
     
            }
        });
 });

