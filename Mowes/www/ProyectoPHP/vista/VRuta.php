<?
include("../modelo/Ruta.php");
include("../control/CtrRuta.php");
include("../control/CtrConexion.php");

    $id_ruta="";
    $descripcion="";
    $boton="";
    $ArrayRuta = null;
    $x="";
    $cont=0;
    $tam=0;

    function Validar($id_ruta, $descripcion)
    {
		if($id_ruta=="")
        {
		    echo "<script>alert(\"Debe ingresar el código de la ruta\");</script>";
            return false;
        }

        if($descripcion=="")
        {
		    echo "<script>alert(\"Debe ingresar la descripción de la Ruta\"); </script>";
            return false;
        }
    return true;
    }


 try
 {
    $id_ruta=$_POST["codigo"];
    $descripcion=$_POST["descripcion"];
    $boton=$_POST["accion"];

		if($boton =="Insertar")
		{
            if( Validar($id_ruta, $descripcion) )
    		{
    		    $objRuta=new Ruta($id_ruta,$descripcion);
                $objCtrRuta=new CtrRuta($objRuta);
                $objCtrRuta->guardar();
				//preguntar al profe para qué sirve las 3 lineas siguientes:
                $id_ruta=$objRuta->getId_Ruta();
                $descripcion = $objRuta->getDescripcion();
                $ArrayRuta=$objCtrRuta->Listar();
                $tam = $ArrayRuta[0][0];
    		}
		}


	   if($boton =="Listar")
	   {
	        $objRuta=new Ruta('','');
            $objCtrRuta=new CtrRuta($objRuta);
            $ArrayRuta=$objCtrRuta->Listar();
            $tam = $ArrayRuta[0][0];
       }

       if($boton =="Modificar")
       {
	        if( Validar($id_ruta, $descripcion))
	        {
                $objRuta=new Ruta($id_ruta,$descripcion);
                $objCtrRuta=new CtrRuta($objRuta);
                $objCtrRuta->Modificar();
                $id_ruta=$objRuta->getId_Ruta();
                $descripcion = $objRuta->getDescripcion();
                $ArrayRuta=$objCtrRuta->Listar();
                $tam = $ArrayRuta[0][0];
			 }
	   }


	   if($boton =="Consultar")
	   {
	   		if($id_ruta=="")
			{
				echo "<script>alert(\"Ingrese el Código de la Ruta\"); </script>";
			}
			else
			{
                $objRuta=new Ruta($id_ruta,"");
                $objCtrRuta=new CtrRuta($objRuta);
                $objRuta=$objCtrRuta->Consultar();
                $id_ruta=$objRuta->getId_Ruta();
                $descripcion = $objRuta->getDescripcion();
			}
        echo  $id_ruta;
		echo  $descripcion;
        //$ArrayRuta = $objCtrRuta->Listar();
        //$tam = $ArrayRuta[0][0];
		}
}
catch (Exception $exp)
{
    echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
}

echo

"<html>
<head>
    <title>Rutas de Viajes</title>
    <script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
    <script type=\"text/javascript\" src=\"../EstilosJS/Cliente.js\"></script>
    <link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
	<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>

<body>
 <form name=\"frmruta\" action=\"VRuta.php\" method=\"post\">
  <table align=\"center\" border=\"1\">

    <tr>
    <th align=\"center\" colspan=\"2\"><b> Rutas de Viajes </b> </th>
    </tr>

    <tr>
    <td>Código de la Ruta:</td>
    <td><input type=\"text\" name=\"codigo\" ID=\"codigo\" VALUE =\"".$id_ruta."\"/></td>
    </tr>

    <tr>
    <td>Descripción de la Ruta:</td>
    <td><input type=\"text\" ID=\"descripcion\" name=\"descripcion\" VALUE =\"".$descripcion."\"/></td>
    </tr>
  </table>

  <table align=\"center\">
    <tr>
     <td><input type=\"image\"  src=\"../Imagenes/consultar.jpg\" name=\"accion\"  value=\"Consultar\" ></td>
     <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Modificar\" ></td>
     <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Insertar\" ></td>
     <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Listar\" ></td>
     <td><input type=\"submit\" class=\"boton\"  name=\"accion\"  value=\"Borrar\"> </td>
    </tr>
  </table>

 </form>
</body>
</html>";

$x="<center><table border='1'><tr><th>Código</th><th>Descripción</th></tr>";
       for($cont=1;$cont<= $tam;$cont++)
       {
            $x=$x."<tr onMouseOver=\"pintar(this,'#D8D8D8')\" onMouseOut=\"pintar(this,'')\"><td>".$ArrayRuta [$cont][0]."</td><td>".$ArrayRuta[$cont][1]."</td><td>".$ArrayRuta [$cont][2]."</td></tr>";
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
?>