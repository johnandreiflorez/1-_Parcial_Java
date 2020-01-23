<?
include("../modelo/TipVehiculo.php");
include("../control/CtrTipVehiculo.php");
include("../control/CtrConexion.php");

    $idTipVehiculo="";
    $Descripcion="";
	$boton="";
	$ArrayVehiculo = null;
	$x="";
	$cont=0;
	$tam=0;
  try{
	$idTipVehiculo=$_POST["idTipVehiculo"];
    $Descripcion=$_POST["Descripcion"];
    $boton=$_POST["accion"];

		if($boton =="Insertar"){
		
		
				$objTipVehiculo=new TipVehiculo($idTipVehiculo,$Descripcion);
				$objCtrTipVehiculo=new CtrTipVehiculo($objTipVehiculo);
				$objCtrTipVehiculo->guardar();
				//preguntar al profe para qué sirve las 3 lineas siguientes:
				 $idTipVehiculo=$objTipVehiculo->getidTipVehiculo();
				 $Descripcion=$objTipVehiculo->getDescripcion();
				 $ArrayVehiculo = $objCtrTipVehiculo->Listar();
				 $tam = $ArrayVehiculo[0][0];
				  echo "<script>alert(\"El resultado de del comando SQL es:". $Descripcion."\"); </script>";
		
		}
		
		   if($boton =="Listar"){
             $objTipVehiculo=new TipVehiculo('','');
             $objCtrTipVehiculo =new CtrTipVehiculo($objTipVehiculo);
             $ArrayVehiculo = $objCtrTipVehiculo->Listar();
             $tam = $ArrayVehiculo[0][0];
			}
			
			if($boton =="Modificar"){
    	    $objTipVehiculo=new TipVehiculo($idTipVehiculo,$Descripcion);
    	    $objCtrTipVehiculo=new CtrTipVehiculo($objTipVehiculo);
    	    $objCtrTipVehiculo->Modificar();
             $idTipVehiculo=$objTipVehiculo->getidTipVehiculo();
			 $Descripcion=$objTipVehiculo->getDescripcion();
             $ArrayVehiculo = $objCtrTipVehiculo->Listar();
             $tam = $ArrayVehiculo[0][0];
			}
			
			if($boton =="Consultar"){
				
				
					$objTipVehiculo=new TipVehiculo($idTipVehiculo,"","");	
					 $objCtrTipVehiculo=new CtrTipVehiculo($objTipVehiculo);
					 $objTipVehiculo = $objCtrTipVehiculo->Consultar();
					 $idTipVehiculo=$objTipVehiculo->getidTipVehiculo();
					 $Descripcion=$objTipVehiculo->getDescripcion();
					
				}

			 
    
	
	 }
     catch (Exception $exp)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
        }

echo

"<html>
<head>
<title>Manejo de Tipos de Vehiculo</title>
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarTipoVehiculo.js\"></script>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>
<body>
<form name=\"frmTipVehiculo\" action=\"VTipVehiculo.php\" method=\"post\">
<table align=\"center\" border=\"1\" >
<tr>
<th align=\"center\" colspan=\"2\"><b> Manejo de Tipos de Vehiculo </b>
</th>
</tr>
<tr>
<td>Codigo TipVehiculo:</td>
<td><input type=\"text\" name=\"idTipVehiculo\" ID=\"idTipVehiculo\" VALUE =\"".$idTipVehiculo."\"/></td>
</tr>
<tr>
<td>Descripcion:</td>
<td><input type=\"text\" ID=\"Descripcion\" name=\"Descripcion\" VALUE =\"".$Descripcion."\"/></td>
</tr>

</table>

<table align=\"center\">
<tr>
 <td><input type=\"submit\" class=\"boton\"  id =\"Consultar\" name=\"accion\"  value=\"Consultar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Modificar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  id =\"Insertar\" name=\"accion\"  value=\"Insertar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Listar\" ></td>
</tr>
</table>

</form>

</body>
</html>";

             $x="<center><table border='1' ><tr><th>idTipVehiculo</th><th>Descripcion</th></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayVehiculo [$cont][0]."</td><td>".$ArrayVehiculo[$cont][1]."</td></tr>";
              }
              $x=$x."</table></center>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;
   ?>