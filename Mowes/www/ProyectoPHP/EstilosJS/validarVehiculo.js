$(document).ready(function ()
			{

				var Id_VEHI;
				var Descripcion_VEH;
				var IdTipoVehi;
				$('#Id_VEHI').focus();

				$('#Insertar').click(function() {
					return ValidarCampos();
				})
				
				$('#Consultar').click(function() {
				Id_VEHI= $('#Id_VEHI').val();
				if (!vacio(Id_VEHI))
				{
					alert("Debe ingresar el Id del Vehiculo");
					$('#Id_VEHI').focus();
					return false;
				}
				/*$("#Id_VEHI").attr("disabled","disabled");*/
				
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
		Id_VEHI= $('#Id_VEHI').val();
		Descripcion_VEH= $('#Descripcion_VEH').val();	
		IdTipoVehi= $('#IdTipoVehi').val();
		
		if (!vacio(Id_VEHI))
		{
			alert("Debe ingresar la identificaci�n del Veh�culo");
			$('#Id_VEHI').focus();
			return false;
		}
		
		if (!vacio(Descripcion_VEH))
		{
			alert("Debe ingresar la placa del Veh�culo");
			$('#Descripcion_VEH').focus();
			return false;
		}
		
		if(IdTipoVehi==0)
		{
		alert("Debe seleccionar el tipo de Veh�culo");
		$('#IdTipoVehi').focus();
		return false;
		}
		return true;
	}
	