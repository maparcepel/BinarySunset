 $(document).ready(function(){
     
       $( "#menu_inici" ).load( "menu_inici.html" );
       
       $(window).resize (function(){
           if ($(window).width() > 1300){
               $('#contenedor').addClass('container').removeClass('container-fuid');
           }
       });
       $(window).resize (function(){
           if ($(window).width() < 1300){
               $('#contenedor').addClass('container-fluid').removeClass('container');
           }
       });
 });

