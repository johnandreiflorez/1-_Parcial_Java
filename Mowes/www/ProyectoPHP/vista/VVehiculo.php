<?
	include("../modelo/Vehiculo.php");
	include("../control/CtrVehiculo.php");
	include("../control/CtrConexion.php");

	$Id_VEHI="";
	$Descripcion_VEH="";
	$IdTipoVehi=0;
	$boton="";
	$ArrayTipVehi = null;
	$x="";
	$cont=0;
	$tam=0;
	$todobn;
	
	
	try{
	$Id_VEHI=$_POST["Id_VEHI"];
    $Descripcion_VEH=$_POST["Descripcion_VEH"];
	$IdTipoVehi=$_POST["IdTipoVehi"];  
    $boton=$_POST["accion"];
	
	$objVehiculo=new Vehiculo("", "", "");
	$objCtrVehiculo=new CtrVehiculo($objVehiculo);
	$ArrayTipVehi= $objCtrVehiculo->listarTipoVehi();
	$tam = $ArrayTipVehi[0][0];
		
		if($boton =="Insertar"){
				$objVehiculo=new Vehiculo($Id_VEHI, $Descripcion_VEH, $IdTipoVehi);
				$objCtrVehiculo=new CtrVehiculo($objVehiculo);
				$todobn=$objCtrVehiculo->guardar();
				if($todobn>=1)
				{
					$boton="Consultar";
					echo "<script>alert(\"El vehiculo :". $Id_VEHI." ya existe\");</script>";
				}
				
				echo "<script>alert(\"Se ingresó el vehiculo:". $Descripcion_VEH."\");</script>";
		}
		
		if($boton =="Consultar"){
		
				$objVehiculo=new Vehiculo($Id_VEHI, $Descripcion_VEH, $IdTipoVehi);
				$objCtrVehiculo=new CtrVehiculo($objVehiculo);
				 $objVehiculo = $objCtrVehiculo->Consultar();
				 $Id_VEHI=$objVehiculo->getidVehiculo();
				 $Descripcion_VEH=$objVehiculo->getDescripcion();
				 $IdTipoVehi=$objVehiculo->getidTipVehiculo();
			
		}
		
		if($boton =="Modificar"){
			$objVehiculo=new Vehiculo($Id_VEHI, $Descripcion_VEH, $IdTipoVehi);
			$objCtrVehiculo=new CtrVehiculo($objVehiculo);
			$objCtrVehiculo->Modificar();
			
			 /*$identificacion=$objCliente->getIdentificacion();
			 $nombre=$objCliente->getNombre();
			 $telefono=$objCliente->getTelefono();
			 $ArrayClientes = $objCtrCliente->Listar();
			 $tam = $ArrayClientes[0][0];*/
		}
		
		if($boton =="Eliminar"){
			$objVehiculo=new Vehiculo($Id_VEHI, $Descripcion_VEH, $IdTipoVehi);
			$objCtrVehiculo=new CtrVehiculo($objVehiculo);
			$objCtrVehiculo->Eliminar();
			
			 /*$identificacion=$objCliente->getIdentificacion();
			 $nombre=$objCliente->getNombre();
			 $telefono=$objCliente->getTelefono();
			 $ArrayClientes = $objCtrCliente->Listar();
			 $tam = $ArrayClientes[0][0];*/
		}
	}
	catch (Exception $exp)
	{
		echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
	}
echo
"<html>
<head>
<title>Manejo de Vehículos</title>
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarVehiculo.js\"></script>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">

<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>
<body>
<form name=\"frmcliente\" action=\"VVehiculo.php\" method=\"post\">
<table align=\"center\" border=\"1\" >
<tr>
<th align=\"center\" colspan=\"2\"><b> Manejo de Vehículos </b>
</th>
</tr>
<tr>
<td>Código del Vehículo:</td>
<td><input type=\"text\" ID=\"Id_VEHI\" name=\"Id_VEHI\" VALUE =\"".$Id_VEHI."\"/></td>
</tr>
<tr>
<td>Placa:</td>
<td><input type=\"text\" ID=\"Descripcion_VEH\" name=\"Descripcion_VEH\" VALUE =\"".$Descripcion_VEH."\"/></td>
</tr>
<tr>
<td>Tipo Vehículo:</td>
<td>
<select ID=\"IdTipoVehi\" name=\"IdTipoVehi\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tam;$cont++){
 $listaTel=$listaTel."<option value=\"".$ArrayTipVehi[$cont][0]."\">".$ArrayTipVehi[$cont][1]."</option>";

}
$listaTel=$listaTel."</select>";
echo $listaTel.
"<br>
</td>
</tr>
</table>

<table align=\"center\">
<tr>
 <td><input type=\"submit\" class=\"boton\" ID=\"Consultar\" name=\"accion\"  value=\"Consultar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Modificar\" name=\"accion\"  value=\"Modificar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Insertar\" name=\"accion\"  value=\"Insertar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Listar\" name=\"accion\"  value=\"Listar\" ></td>
  <td><input type=\"submit\" class=\"boton\" ID=\"Eliminar\" name=\"accion\"  value=\"Eliminar\" ></td>
</tr>
</table>

</form>
</body>
</html>";

echo "<script language=\"javascript\">
$(document).ready(function ()
{
	$('#Id_VEHI').focus();
	$('#IdTipoVehi option[value=".$IdTipoVehi."]').attr('selected',true);
})
				
</script>";



?>