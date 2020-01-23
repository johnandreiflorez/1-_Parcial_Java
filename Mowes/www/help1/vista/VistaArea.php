<?
//--------INCLUIMOS LOS ARCHIVOS QUE NECESITAMOS PARA CREAR LOS OBJETOS---------------------------
include("../modelo/Area.php");
include("../control/CtrArea.php");
include("../control/CtrConexion.php");

  //SI SE DIÓ CLICK AL BOTÓN GUARDAR, SE EJECUTA EL CÓDIGO A CONTINUACIÓN
if($Guardar){
		//--------ASIGNAMOS LOS VALORES QUE VIENEN POR POST A LAS VARIABLES QUE VAMOS A UTILIZAR----------
    $idarea=$_POST["idarea"];
    $nombre=$_POST["nombre"];
    $fkemple= $_POST["fkemple"];



    $ObjArea=new Area($idarea,$nombre,$fkemple);

    $ObjCtrArea=new CtrArea($ObjArea);

    $ObjCtrArea->guardar();
    echo "<center>REGISTRO ALMACENADO</center>";
}
  //SI SE DIÓ CLICK AL BOTÓN CONSULTAR, SE EJECUTA EL CÓDIGO A CONTINUACIÓN
if($Consultar){
		// SE ASIGNA A UNA VARIABLE, EL VALOR DEL CUADRO DE TEXTO IDAREA
    $idarea=$_POST["idarea"];



    $ObjArea=new Area($idarea,'','');

    $ObjCtrArea=new CtrArea($ObjArea);
     //CONSULTAR TERMINA DE ASIGNAR LOS VALORES A LOS ATRIBUTOS NOMBRE Y FKEMPLE DE $objArea
    $ObjCtrArea->consultar();
    //SE RECURRE A LOS MÉTODOS getNombre y getFkEmple para asignar las variables $nombre y $fkemple
    $nombre=$ObjArea->getNombre();
    $fkemple= $ObjArea->getFkEmple();

   //   SE MUESTRA UNA PÁGINA HTML IDÉNTICA A vistaArea.html con los CUADROS DE TEXTO Y BOTONES
   //NOTE QUE SE DEBE COLOCAR \" DONDE HAY UNA COMILLA DOBLE, EXCEPTO LA PRIMERA Y LA ÚLTIMA DESPUÉS DE echo
  echo "<center>
<h3>Area</h3><form>
	<table border=\"1\">
		<tr>
			<td>Codigo Area:</td>
			<td><input type=\"text\" size=\"10\" maxlength=\"10\" name=\"idarea\"value='$idarea' ></td>
		</tr>
		<tr>
			<td>Nombre Area:</td>
			<td><input type=\"text\" size=\"60\" maxlength=\"60\" name=\"nombre\" value='$nombre'></td>
		</tr>
        		<tr>
			<td>Código Jefe:</td>
			<td><input type=\"text\" size=\"60\" maxlength=\"60\" name=\"fkemple\" value='$fkemple'></td>
		</tr>
	</table>
	<input type=\"submit\" value=\"Guardar\" name=\"Guardar\">
    <input type=\"submit\" value=\"Borrar\" name=\"Borrar\">
    <input type=\"submit\" value=\"Modificar\" name=\"Modificar\">
    <input type=\"submit\" value=\"Consultar\" name=\"Consultar\">
    <input type=\"submit\" value=\"ListarAreas\" name=\"ListarAreas\">
 </form></center>";
 }
//SI SE DIÓ CLICK AL BOTÓN LISTARAREAS, SE EJECUTA EL CÓDIGO A CONTINUACIÓN
if($ListarAreas){
$objArea= new Area(0,'',0);
$objCtrArea= new CtrArea($objArea);
//$mat ES UNA MATRIZ CON LOS DATOS DE LAS AREAS (CADA FILA REPRESENTA UN REGISTRO)
//EN LA COLUMNA 1 ESTÁ EL IDAREA
//EN LA COLUMNA 2 ESTÁ EL NOMBRE
//EN LA COLUMNA 3 ESTÁ EL FKEMPLE
$mat= $objCtrArea->listarAreas();

//LA VARIABLE X, ES UNA CADENA DE CARACTERES CON EL CÓDIGO HTML QUE MUESTRA UNA TABLA CON LOS REGISTROS
//GUARDADOS EN LA MATRIZ
//RECUERDE QUE EL OPERADOR PUNTO ES PARA CONCATENAR
//EN  $mat[1][4], VIENE ALMACENADO EL NÚMERO DE FILAS (REGISTROS) DE LA MATRIZ

             $x="<table border='1'><tr><td>Codigo Area:</td><td>Nombre Area</td><td>Jefe</td></tr>";
              for($i=1;$i<=$mat[1][4];$i++){
              		$x=$x."<tr><td>".$mat[$i][1]."</td><td>".$mat[$i][2]."</td><td>".$mat[$i][3]."</td></tr>";
              }
              $x=$x."</table>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;
}
?>