<?
	include("../modelo/Viaje.php");
	include("../control/CtrViajes.php");
	include("../control/CtrVehiculo.php");
	include("../control/CtrConexion.php");
	
	$idRuta=0;
	$TipVehiculo=0;
	$IdVehiculo=0;
	$Fecha = "";
	$Hora = "";
	$boton="";
	$ArrayRuta = null;
	$ArrayTipVehi = null;
	$ArrayVehi = null;
	$x="";
	$cont=0;
	$tamR=0;
	$tamTv=0;
	$tamv=0;
	$todobn;
	$ArrayViajes=null;
	

	
	try{
	$idRuta=$_POST["IdRuta"];
    $TipVehiculo=$_POST["IdTipoVehi"];
	$IdVehiculo=$_POST["IdVehi"];  
	$Fecha=$_POST["Fecha"]; 
	$Hora=$_POST["Hora"]; 
    $boton=$_POST["accion"];
	
	$objViajes=new Viaje("", "", "", "", "");
	$objCtrViajes=new CtrViajes($objViajes);
	$ArrayRuta= $objCtrViajes->listarRuta();
	$tamR = $ArrayRuta[0][0];
	
	$objCtrVehiculo=new CtrVehiculo("");
	$ArrayTipVehi= $objCtrVehiculo->listarTipoVehi();
	$tamTv = $ArrayTipVehi[0][0];

	$objViajes=new Viaje("", $TipVehiculo, "", "" , "");
	$objCtrViajes=new CtrViajes($objViajes);
	$ArrayVehi= $objCtrViajes->listarVehiculo();
	$tamV = $ArrayVehi[0][0];
	 
			if($boton =="Insertar"){
			
				$objViajes=new Viaje($idRuta,"", $IdVehiculo, $Fecha, $Hora);
				$objCtrViajes=new CtrViajes($objViajes);
				$todobn = $objCtrViajes->guardar();
				if($todobn>=1)
				{
					$boton="Consultar";
					echo "<script>alert(\"El viaje ya ha sido programado\");</script>";
					
					return false;
				}
				echo "<script>alert(\"Información ingresada exitosamente.\");</script>";
				//preguntar al profe para qué sirve las 3 lineas siguientes:
			}
		if($boton =="Listar"){
			$objViajes=new Viaje('','','', '', '');
			$objCtrViajes=new CtrViajes($objViajes);
			$ArrayViajes = $objCtrViajes->Listar();
			$tam = $ArrayViajes[0][0];
		}
	
	}
	catch (Exception $exp)
	{
		echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
	}
echo
"
<html>
<head>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarViaje.js\"></script>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>
<body>
<form name=\"frmviaje\" action=\"VViaje.php\" method=\"post\">
<table align=\"center\" border=\"1\" >
<tr>
<td align=\"center\" colspan=\"2\"><b> Programación de viajes </b>
</td>
</tr>
<tr>
<td>Tipo de Vehiculo:</td>
<td><select ID=\"IdTipoVehi\" onchange = \"document.frmviaje.submit()\"  name=\"IdTipoVehi\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tamTv;$cont++){
 $listaTipVehi=$listaTipVehi."<option value=\"".$ArrayTipVehi[$cont][0]."\">".$ArrayTipVehi[$cont][1]."</option>";

}
$listaTipVehi=$listaTipVehi."</select>";
echo $listaTipVehi.
"
</td>
</tr>
<tr>
<td>Vehículo:</td>
<td><select ID=\"IdVehi\" name=\"IdVehi\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tamV;$cont++){
 $listaVehi=$listaVehi."<option value=\"".$ArrayVehi[$cont][0]."\">".$ArrayVehi[$cont][1]."</option>";

}
$listaVehi=$listaVehi."</select>";
echo $listaVehi.
"<br>
</td>
</tr>
<tr>
<td>Ruta:</td>
<td><select ID=\"IdRuta\" name=\"IdRuta\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tamR;$cont++){
 $listaRuta=$listaRuta."<option value=\"".$ArrayRuta[$cont][0]."\">".$ArrayRuta[$cont][1]."</option>";
}
$listaRuta=$listaRuta."</select>";
echo $listaRuta.
"<br>
</td>
</tr>
<tr>
<td>Fecha:</td>
<td><input type=\"text\" name=\"Fecha\" ID=\"Fecha\" value=\"AAAA-MM-DD\"/ VALUE =\"".$Fecha."\"/></td>
</tr>
<tr>
<td>Hora:</td>
<td><select ID=\"Hora\" name=\"Hora\" >
<option value=\"06:00\">06:00</option>
<option value=\"07:00\">07:00</option>
<option value=\"08:00\">08:00</option>
<option value=\"09:00\">09:00</option>
<option value=\"10:00\">10:00</option>
<option value=\"11:00\">11:00</option>
<option value=\"12:00\">12:00</option>
<option value=\"14:00\">14:00</option>
<option value=\"15:00\">15:00</option>
<option value=\"16:00\">16:00</option>
<option value=\"17:00\">17:00</option>
<option value=\"18:00\">18:00</option>
</td>
</tr>
</table>
<center>
<table>
<tr>
<tr>
 <td><input type=\"submit\" class=\"boton\"  id=\"Insertar\" name=\"accion\" value=\"Insertar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  id=\"Listar\" name=\"accion\" value=\"Listar\" ></td>
</tr>
</table>
</center>
</form>
</body>
</html>";

  $x="<center><table border='1'><tr><th>Ruta</th><th>Tipo Vehículo</th><th>Placa</th><th>Fecha</th><th>Hora</th></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr onMouseOver=\"pintar(this,'#D8D8D8')\" onMouseOut=\"pintar(this,'')\">
					<td>".$ArrayViajes [$cont][0]."</td>
					<td>".$ArrayViajes[$cont][1]."</td>
					<td>".$ArrayViajes [$cont][2]."</td>
					<td>".$ArrayViajes [$cont][3]."</td>
					<td>".$ArrayViajes [$cont][4]."</td>
					</tr>";
              }
              $x=$x."</table></center>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;

echo "<script language=\"javascript\">
$(document).ready(function ()
{
	$('#IdRuta').focus();
	$('#IdTipoVehi option[value=".$TipVehiculo."]').attr('selected',true);
})
				
</script>";
?>