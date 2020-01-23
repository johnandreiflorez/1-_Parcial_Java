
			$(document).ready(function ()
			{
				var nomUsuario;
				var contrasena;
				
				$('#nomUsuario').focus();

				$('#insertar').click(function() {
					return ValidarCampos();
				})				
				
				$('#modificar').click(function() {
					return ValidarCampos();
				})
				
				$('#borrar').click(function() {
					return ValidarCampos();
				})
				
								
				$('#consultar').click(function() {
				identificacion= $('#nomUsuario').val();
				if (!vacio(identificacion))
				{
					alert("Debe ingresar el nombre de usuario valido");
					$('#nomUsuario').focus();
					return false;
				}
				return true;
				})
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
		nomUsuario= $('#nomUsuario').val();
		contrasena= $('#contrasena').val();
		
		
		if (!vacio(nomUsuario))
		{
			alert("Debe ingresar un nombre de usuario");
			$('#nomUsuario').focus();
			return false;
		}
		
		if (!vacio(contrasena))
		{
			alert("Debe ingresar una contraseña");
			$('#contrasena').focus();
			return false;
		}
		
		
		return true;
	}
	

