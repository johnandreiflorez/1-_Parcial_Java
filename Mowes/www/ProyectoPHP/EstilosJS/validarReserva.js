
			$(document).ready(function ()
			{
				var identificacion;
				var nombre;
				var telefono;
				$('#nombre').attr('readonly', true);
				$('#telefono').attr('readonly', true);
				
				$('#identificacion').focus();

				$('#BuscarViaje').click(function() {
					return ValidarCampos();
				})
				
				
				$('#BuscarCli').click(function() {
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
		IdTipoVehi= $('#IdTipoVehi').val();
		IdRuta= $('#IdRuta').val();
		Fecha= $('#Fecha').val();
		
		if (!vacio(identificacion))
		{
			alert("Debe buscar un cliente para la reserva");
			$('#identificacion').focus();
			return false;
		}
		
		if (!vacio(nombre))
		{
			alert("Debe buscar un cliente para la reserva");
			$('#nombre').focus();
			return false;
		}
		
		if (!vacio(telefono))
		{
			alert("Debe buscar un cliente para la reserva");
			$('#telefono').focus();
			return false;
		}
		
		if(IdTipoVehi==0)
		{
		alert("Debe seleccionar el tipo de Vehículo");
		$('#IdTipoVehi').focus();
		return false;
		}
		
		if(!vacio(Fecha))
		{
			alert("El campo fecha es obligatorio");
			$('#Fecha').focus();
			return false;
		}
		
		if(IdRuta==0)
		{
			alert("Debe seleccionar una ruta");
			$('#IdRuta').focus();
			return false;
		}
		
		return true;
	}
	

