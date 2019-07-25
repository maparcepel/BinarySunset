 $(document).ready(function(){
 
        $.ajax({
            url: 'proyecto_usuario_consulta.php',
            type: 'post',
            data: { "grupo":usuario},
            success: function(canciones) {
                var i = 0;
            $.each(canciones, function() {
               item = '<li><h6><a href="mixatron/mixatron_usuario.php?var cancion=' + canciones[i] + '">'+ canciones[i] + '</a></h6></li>';
                $('#canciones').append(item);
               i++;
             });
            }
        });
     
     
     
 });

