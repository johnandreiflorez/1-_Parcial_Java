$(document).ready(function ()
			{

				var usuario;
				var contrasena;
				$('#usuario').focus();

				$('#Ingresar').click(function() {
					return ValidarCampos();
				})
				
				return true;
		
			})
			
	function vacio(campo)
		{for ( i = 0; i < campo.length; i++ ) {
                if ( campo.charAt(i) != " " ) {
                        return true;
                }
        }
        return false;
	}
	
	function ValidarCampos()
	{
		usuario= $('#usuario').val();
		contrasena= $('#contrasena').val();	
		
		if (!vacio(usuario))
		{
			alert("Ingrese su Nombre de Usuario");
			$('#usuario').focus();
			return false;
		}
		
		if (!vacio(contrasena))
		{
			alert("Debe ingresar su contraseña");
			$('#contrasena').focus();
			return false;
		}
		
		return true;
	}
	