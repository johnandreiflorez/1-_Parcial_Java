
			$(document).ready(function ()
			{
				var identificacion;
				var nombre;
				var telefono;
				$('#identificacion').focus();

				$('#Insertar').click(function() {
					return ValidarCampos();
				})
				
				$('#Modificar').click(function() {
					return ValidarCampos();
				})
				
				$('#Consultar').click(function() {
				identificacion= $('#identificacion').val();
				if (!vacio(identificacion))
				{
					alert("Debe ingresar la identificación del cliente");
					$('#identificacion').focus();
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
		identificacion= $('#identificacion').val();
		nombre= $('#nombre').val();
		telefono= $('#telefono').val();
		
		if (!vacio(identificacion))
		{
			alert("Debe ingresar la identificación del cliente");
			$('#identificacion').focus();
			return false;
		}
		
		if (!vacio(nombre))
		{
			alert("Debe ingresar el nombre del cliente");
			$('#nombre').focus();
			return false;
		}
		
		if (!vacio(telefono))
		{
			alert("Debe ingresar el teléfono del cliente");
			$('#telefono').focus();
			return false;
		}

		return true;
	}
	

