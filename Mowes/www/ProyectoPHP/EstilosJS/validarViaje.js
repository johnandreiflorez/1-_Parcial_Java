$(document).ready(function ()
			{

				var IdTipoVehi;
				var IdVehi	;
				var IdRuta;
			
				

				$('#Insertar').click(function() {
					return ValidarCampos();
				})
				
				/*$('#Consultar').click(function() {
				Id_VIAJ= $('#IdTipoVehi').val();
				if (!vacio(Id_VIAJ))
				{
					alert("Debe ingresar el Id del Vehiculo");
					$('#Id_VEHI').focus();
					return false;
				}*/
				/*$("#Id_VEHI").attr("disabled","disabled");*/
				
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
		IdTipoVehi= $('#IdTipoVehi').val();
		IdVehi= $('#IdVehi').val();	
		IdRuta= $('#IdRuta').val();
		Fecha= $('#Fecha').val();
		
		if (IdTipoVehi == 0)
		{
			alert("Debe ingresar el tipo de vehiculo");
			$('#IdTipoVehi').focus();
			return false;
		}
		
		if (IdVehi == 0)
		{
			alert("Debe ingresar el vehiculo");
			$('#IdVehi').focus();
			return false;
		}
		if (IdRuta == 0)
		{
			alert("Debe ingresar la ruta");
			$('#IdRuta').focus();
			return false;
		}
		
		if (Fecha=='AAAA-MM-DD')
		{
			alert("Debe ingresar la fecha");
			$('#Fecha').focus();
			return false;
		}
		return true;
	}
	