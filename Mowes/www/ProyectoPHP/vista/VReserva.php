<?
include("../modelo/Cliente.php");
include("../modelo/Reserva.php");
include("../modelo/Vehiculo.php");
include("../control/CtrVehiculo.php");
include("../control/CtrReserva.php");
include("../control/CtrCliente.php");
include("../control/CtrConexion.php");

    $identificacion="";
    $nombre="";
	$telefono="";
	$boton="";
	$ArrayReserva = null;
	$x="";
	$cont=0;
	$tam=0;
	$todobn;
	$Fecha = "";
	$CodigoViaje="";
	$Cantidad="";
	
	$Id_RUT_VIAJ="";
	$Fecha_VIAJ="";
	$Id_VEH_VIAJ="";
	
	$objReserva = new Reserva("", "", "", "","","","");
	$objCtrReserva=new CtrReserva($objReserva);
	$ArrayRuta= $objCtrReserva->listarRuta();
	$tamR = $ArrayRuta[0][0];
	
	$objVehiculo=new Vehiculo("", "", "");
	$objCtrVehiculo=new CtrVehiculo($objVehiculo);
	$ArrayTipVehi= $objCtrVehiculo->listarTipoVehi();
	$tamTv = $ArrayTipVehi[0][0];
	
  try{
	$identificacion=$_POST["identificacion"];
    $nombre=$_POST["nombre"];
	$telefono=$_POST["telefono"];  
    $boton=$_POST["accion"];
	
	$Id_RUT_VIAJ=$_POST["IdRuta"];  
	$Fecha_VIAJ=$_POST["Fecha"];  
	$Id_VEH_VIAJ=$_POST["IdTipoVehi"];  
	
	$CodigoViaje=$_POST["CodigoViaje"];  
	$Cantidad=$_POST["Cantidad"];  

		
		if($boton =="Insertar"){
			
			$objReserva=new Reserva($CodigoViaje,$identificacion,$Cantidad,1,"","","");
			$objCtrReserva=new CtrReserva($objReserva);
			$todobn = $objCtrReserva->guardar();
			echo "<script>alert(\"Información ingresada exitosamente.\");</script>";
				//preguntar al profe para qué sirve las 3 lineas siguientes:
		}
		
	   if($boton =="Listar"){
		 $objCliente=new Cliente('','','');
		 $objCtrCliente =new CtrCliente($objCliente);
		 $ArrayClientes = $objCtrCliente->Listar();
		 $tam = $ArrayClientes[0][0];
		}
			
		if($boton =="Modificar"){
			$objCliente=new Cliente($identificacion,$nombre,$telefono);
			$objCtrCliente=new CtrCliente($objCliente);
			$objCtrCliente->Modificar();
			 $identificacion=$objCliente->getIdentificacion();
			 $nombre=$objCliente->getNombre();
			 $telefono=$objCliente->getTelefono();
			 $ArrayClientes = $objCtrCliente->Listar();
			 $tam = $ArrayClientes[0][0];
		}
			
		if($boton =="BuscarCli"){
				$objCliente=new Cliente($identificacion,"","");	
				 $objCtrCliente=new CtrCliente($objCliente);
				 $objCliente = $objCtrCliente->Consultar();
				 $identificacion=$objCliente->getIdentificacion();
				 $nombre=$objCliente->getNombre();
				 $telefono=$objCliente->getTelefono();
		}
		
		if($boton =="BuscarViaje"){
			$objReserva=new Reserva('','','', '',$Id_RUT_VIAJ, $Fecha_VIAJ, $Id_VEH_VIAJ);
			$objCtrReserva=new CtrReserva($objReserva);
			$ArrayReserva = $objCtrReserva->ListarViajesRes();
			$tam = $ArrayReserva[0][0];
		}
	
	 }
     catch (Exception $exp)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
        }

echo

"<html>
<head>
<title>PROGRAMACIÓN DE RESERVAS</title>
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarReserva.js\"></script>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>

<body>
<form name=\"frmcliente\" action=\"VReserva.php\" method=\"post\">
<table align=\"center\" border=\"1\">
<tr>
<th align=\"center\" colspan=\"2\"><b> PROGRAMACIÓN DE RESERVAS </b>
</th>
</tr>
<tr>
<td>Documento del cliente:</td>
<td><input type=\"text\" name=\"identificacion\" ID=\"identificacion\" VALUE =\"".$identificacion."\"/> 
<input type=\"image\"  src=\"../Imagenes/buscar.png\" ID=\"BuscarCli\" name=\"accion\"  value=\"BuscarCli\" >
</td>
</tr>
<tr>
<td>Nombre:</td>
<td><input type=\"text\" ID=\"nombre\" name=\"nombre\" VALUE =\"".$nombre."\"/></td>
</tr>
<tr>
<td>Telefono:</td>
<td><input type=\"text\" ID=\"telefono\" name=\"telefono\" VALUE =\"".$telefono."\"/></td>
</tr>
<td>Ruta:</td>
<td><select ID=\"IdRuta\" name=\"IdRuta\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tamR;$cont++){
 $listaRuta=$listaRuta."<option value=\"".$ArrayRuta[$cont][0]."\">".$ArrayRuta[$cont][1]."</option>";
}
$listaRuta=$listaRuta."</select>";
echo $listaRuta.
"<br>
</td>
<tr>
<td>Fecha:</td>
<td><input type=\"text\" name=\"Fecha\" ID=\"Fecha\" value=\"AAAA-MM-DD\"/ VALUE =\"".$Fecha."\"/></td>
</tr>
<tr>
<td>Tipo Vehículo:</td>
<td>
<select ID=\"IdTipoVehi\" name=\"IdTipoVehi\"><option value=\"0\">Seleccione</option>";
for($cont=1;$cont<= $tamTv;$cont++){
 $listaTel=$listaTel."<option value=\"".$ArrayTipVehi[$cont][0]."\">".$ArrayTipVehi[$cont][1]."</option>";

}
$listaTel=$listaTel."</select>";
echo $listaTel.
"<input type=\"image\"  src=\"../Imagenes/buscar.png\" ID=\"BuscarViaje\" name=\"accion\"  value=\"BuscarViaje\" >
<br>
</td>
</tr>
<tr>
<td>Codigo Viaje:</td>
<td><input type=\"text\" name=\"CodigoViaje\" ID=\"CodigoViaje\"  VALUE =\"".$CodigoViaje."\"/></td>
</tr>
<tr>
<td>Cantidad Tiquetes:</td>
<td><input type=\"text\" name=\"Cantidad\" ID=\"Cantidad\" VALUE =\"".$Cantidad."\"/></td>
</tr>
</table>

<table align=\"center\">
<tr>
 <td><input type=\"submit\" class=\"boton\" ID=\"Insertar\"  name=\"accion\"  value=\"Insertar\" ></td>
</tr>
</table>
</form>
</body>
</html>";

$x="<center><table border='1'><tr><th>Viaje</th><th>Ruta</th><th>Placa</th><th>Fecha</th><th>Hora</th></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr onMouseOver=\"pintar(this,'#D8D8D8')\" onMouseOut=\"pintar(this,'')\">
					<td>".$ArrayReserva [$cont][0]."</td>
					<td>".$ArrayReserva[$cont][1]."</td>
					<td>".$ArrayReserva [$cont][2]."</td>
					<td>".$ArrayReserva [$cont][3]."</td>
					<td>".$ArrayReserva [$cont][4]."</td>
					</tr>";
              }
              $x=$x."</table></center>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;
			  
echo "<script language=\"javascript\">
function pintar(objeto,col)
{
  objeto.bgColor=col;
}
</script>";

echo "<script language=\"javascript\">
$(document).ready(function ()
{
	$('#identificacion').focus();
})
</script>";
   ?>