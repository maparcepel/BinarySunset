$(document).ready(function(){
		

		$("form").submit(function( event ) {
                                          event.preventDefault();
			var error=false;
			var ierror= false;
			var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
			$(this).find('input:not(input[type=submit]) , textarea').each(function(){
				var input= $(this);
				switch(input.attr('data-rule')){
					case 'required':
						if(input.val()=="") ierror=error=true;
						else ierror=false
					break;

					case 'email':
						if (!emailExp.test(input.val())) ierror=error=true;
						else ierror=false
					break;
				}
				

				if(ierror) $("#error_"+input.attr('name')).text(input.attr('data-msg'));
				else{ 
                                                            $("#error_"+input.attr('name')).text('');
                                                            
                                                         }
			});
			if(error)event.preventDefault();  // impide que se envía el formulario
                                            else{
                                                        $.ajax({
                                                           data: {
                                                                'nombre': $("form").find('input[name=nombre]').val(),
                                                                'email': $("form").find('input[name=email]').val(),
                                                                'comentario': $("form").find('textarea').val(),

//                                                                            'nombre': 'juan',
//                                                                                'email': 'perez@mama.com',
//                                                                                'comentario': 'okk'
                                                                    },
                                                            //Cambiar a type: POST si necesario
                                                            type: "POST",
                                                            // Formato de datos que se espera en la respuesta
                                                            dataType: "json",
                                                            // URL a la que se enviará la solicitud Ajax
                                                            url: "contacte_enviar.php",
                                                        })
                                                        
                                                         .done(function( respuesta) {
                                                             //recibe respuesta de php y la muestra en un span
                                                           $('#respuesta').text(respuesta);
                                                           //borra contenido de los campos
                                                           $("form").find('input[name=nombre]').val('');
                                                           $("form").find('input[name=email]').val('');
                                                           $("form").find('textarea').val('');
//                                                         location.reload();

                                                             
                                                         })
                                                         .fail(function( jqXHR, textStatus, errorThrown ) {
                                                             if ( console && console.log ) {
                                                                 console.log( "La solicitud a fallado: " +  errorThrown);
                                                             }
                                                        });
                                            }
		});

	
	});

	