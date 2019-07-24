 $(document).ready(function(){
     acordeon = $('.accordion');
     var proyectos = ['Low Blows', 'Violet Mistake', 'Celestial Bums', 'Wavelet'];
     var cancion = 'Skin';
     var i = 0;
     $.each(proyectos, function( index, value ) {
        item = $('<div class="card"><div class="card-header" role="tab" id="heading' + i + '"><a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapse' + i + '"aria-expanded="false" aria-controls="collapse' + i + '"><h5 class="mb-0">' + value + ' <i class="fas fa-angle-down rotate-icon"></i></h5></a></div><div id="collapse' + i + '" class="collapse" role="tabpanel" aria-labelledby="heading' + i + '"data-parent="#accordionEx1"><div class="card-body">' + cancion + '</div></div></div>');
        acordeon.append(item);
        i++;
      });
     
     
 });

