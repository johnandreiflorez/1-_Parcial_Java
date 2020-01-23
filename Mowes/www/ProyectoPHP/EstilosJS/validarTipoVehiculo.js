$(document).ready(function ()
			{

				var idTipVehiculo;
				var Descripcion;
				
				$('#idTipVehiculo').focus();

				$('#Insertar').click(function() {
					return ValidarCampos();
				})
				
				$('#Consultar').click(function() {
				idTipVehiculo = $('#idTipVehiculo').val();
				if (!vacio(idTipVehiculo))
				{
					alert("Debe ingresar el Id del tipo Vehiculo para consultar");
					$('#idTipVehiculo').focus();
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
		idTipVehiculo= $('#idTipVehiculo').val();
		Descripcion= $('#Descripcion').val();	
		
		if (!vacio(idTipVehiculo))
		{
			alert("Debe ingresar el código del tipo de vehiculo");
			$('#idTipVehiculo').focus();
			return false;
		}
		
		if (!vacio(Descripcion))
		{
			alert("Debe ingresar una descripcion del tipo de Vehículo");
			$('#Descripcion').focus();
			return false;
		}
		
		return true;
	}
	