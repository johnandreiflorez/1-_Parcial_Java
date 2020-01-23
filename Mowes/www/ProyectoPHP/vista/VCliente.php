<?

include("../modelo/Cliente.php");
include("../control/CtrCliente.php");
include("../control/CtrConexion.php");

session_start();
if (!isset($_SESSION['Usuario']))
    {
		header("location: index.html");
		exit;
    }
    
    $identificacion="";
    $nombre="";
	$telefono="";
	$boton="";
	$ArrayClientes = null;
	$x="";
	$cont=0;
	$tam=0;
	$todobn;
	
	
	function Consultar()
	{
		$objCliente=new Cliente($identificacion,"","");	
		 $objCtrCliente=new CtrCliente($objCliente);
		 $objCliente = $objCtrCliente->Consultar();
		 $identificacion=$objCliente->getIdentificacion();
		 $nombre=$objCliente->getNombre();
		 $telefono=$objCliente->getTelefono();
	}
	
  try{
	$identificacion=$_POST["identificacion"];
    $nombre=$_POST["nombre"];
	$telefono=$_POST["telefono"];  
    $boton=$_POST["accion"];

		if($boton =="Insertar"){
				$objCliente=new Cliente($identificacion,$nombre,$telefono);
				$objCtrCliente=new CtrCliente($objCliente);
				$todobn=$objCtrCliente->guardar();
				if($todobn>=1)
				{
					$boton="Consultar";
					echo "<script>alert(\"El cliente con identificación:". $identificacion." ya existe\");</script>";
				}
				echo "<script>alert(\"Información ingresada exitosamente.\");</script>";
				//preguntar al profe para qué sirve las 3 lineas siguientes:
				 $identificacion=$objCliente->getIdentificacion();
				 $nombre=$objCliente->getNombre();
				 $telefono=$objCliente->getTelefono();
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
			
		if($boton =="Consultar"){
				$objCliente=new Cliente($identificacion,"","");	
				 $objCtrCliente=new CtrCliente($objCliente);
				 $objCliente = $objCtrCliente->Consultar();
				 $identificacion=$objCliente->getIdentificacion();
				 $nombre=$objCliente->getNombre();
				 $telefono=$objCliente->getTelefono();
		}
	
	 }
     catch (Exception $exp)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
        }

echo

"<html>
<head>
<title>Manejo de Clientes</title>
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarCliente.js\"></script>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>

<body>
<form name=\"frmcliente\" action=\"VCliente.php\" method=\"post\">
<table align=\"center\" border=\"1\">
<tr>
<th align=\"center\" colspan=\"2\"><b> Manejo de clientes </b>
</th>
</tr>
<tr>
<td>Identificacion:</td>
<td><input type=\"text\" name=\"identificacion\" ID=\"identificacion\" VALUE =\"".$identificacion."\"/></td>
</tr>
<tr>
<td>Nombre:</td>
<td><input type=\"text\" ID=\"nombre\" name=\"nombre\" VALUE =\"".$nombre."\"/></td>
</tr>
<tr>
<td>Telefono:</td>
<td><input type=\"text\" ID=\"telefono\" name=\"telefono\" VALUE =\"".$telefono."\"/></td>
</tr>
</table>

<table align=\"center\">
<tr>
 <td><input type=\"image\"  src=\"../Imagenes/consultar.jpg\" ID=\"Consultar\" name=\"accion\"  value=\"Consultar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Modificar\"  name=\"accion\"  value=\"Modificar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Insertar\"  name=\"accion\"  value=\"Insertar\" ></td>
 <td><input type=\"submit\" class=\"boton\" ID=\"Listar\" name=\"accion\"  value=\"Listar\" ></td>
</tr>
</table>

</form>
</body>
</html>";

             $x="<center><table border='1'><tr><th>Identificación</th><th>Nombre</th><th>Teléfono</th></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr onMouseOver=\"pintar(this,'#D8D8D8')\" onMouseOut=\"pintar(this,'')\"><td>".$ArrayClientes [$cont][0]."</td><td>".								$ArrayClientes[$cont][1]."</td><td>".$ArrayClientes [$cont][2]."</td></tr>";
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