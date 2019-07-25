 $(document).ready(function(){
     acordeon = $('.accordion');

        $.ajax({
            url: 'proyectos_admin_consulta.php',
            type: 'post',
            data: { "proyectos": "x"},
            success: function(proyectos) {
    //    Crea el menú acordeon y lo pone en la página
                var i = 0;
            $.each(proyectos, function() {
               item = '<div class="card"><div class="card-header" role="tab" id="heading' + i + '"><a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse' + i + '"aria-expanded="false" aria-controls="collapse' + i + '"><h5 class="mb-0">' + proyectos[i][0] + ' <i class="fas fa-angle-down rotate-icon"></i></h5></a></div><div id="collapse' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading' + i + '"data-parent="#accordionEx1"><div class="card-body">';         
               for(var j = 1; j < proyectos[i].length; j++){
                  item += '<p><a href="mixatron/mixatron_admin.php?proyecto=' + proyectos[i][0]  + '&cancion=' + proyectos[i][j] + '">' + proyectos[i][j] + '</a></p>'; 
               }
                item += '</div></div></div>';
                acordeon.append(item);
               i++;
             });
            }
        });

     
     
     
 });

