  $(document).ready(function(){
       pagina = $( "html" ).prop('id').toUpperCase();
       li = $('#menu').find('a').filter(function(indice, elemento){
          return $(elemento).text() === pagina; 
       });
       li.addClass('active');
       
      
        
 });