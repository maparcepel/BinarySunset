$(document).ready(function(){
		

		$("form").submit(function( event ) {
			var error=false;
			var ierror= false;
			var checked= false;
			var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
			
			$(this).children('input:not(input[type=submit],input[type=radio]),textarea').each(function(){
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

					case 'minleng':
						if(input.val().length<4) ierror=error=true;
						else ierror=false	
					break;

					case 'checked':
						if(!input.attr('checked')) ierror=error=true;
						else ierror=false
					break;
				}
				

				if(ierror) $("#error_"+input.attr('name')).text(input.attr('data-msg'));
				else $("#error_"+input.attr('name')).text('');
				
			});
			
		
		  if(error)event.preventDefault();  // impide que se envía el formulario
		});

	
	});

	