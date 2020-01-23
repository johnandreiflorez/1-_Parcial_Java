<?php
include("../modelo/Maestro.php");
include("../modelo/Detalle.php");
include("../control/CtrMaestro.php");
include("../control/CtrDetalle.php");
include("../control/CtrConexion.php");

//Definición de Variables
 $idMaestro =0;
 $nombre= "";
 $dato=0;
 $boton= "";
 $matrizDetalles=null;
 $nuevoDetalle=false;

try{
 $idMaestro=$_POST["txtIdMaestro"];
 $nombre=$_POST["txtNombre"];
 $boton=$_POST["boton"];
 echo  "<br> boton = ".$boton;

switch($boton){
 case "Guardar":
             $objMaestro=new Maestro($idMaestro,$nombre);
             $objCtrMaestro =new CtrMaestro($objMaestro);
             $objCtrMaestro->guardar();
 break;
 case "Consultar":
 $objMaestro=new Maestro($idMaestro,'');

 $objCtrMaestro =new CtrMaestro($objMaestro);
 $objMaestro=$objCtrMaestro->consultar();
 $idMaestro= $objMaestro->getIdMaestro();
 $nombre= $objMaestro->getNombre();

   $objDetalle=new Detalle('',$idMaestro);
    $objCtrDetalle =new CtrDetalle($objDetalle);
   $matrizDetalles= $objCtrDetalle->consultarDetalles();
 break;
 case "Modificar":

 break;
 case "Borrar":

 break;
 case "AgregarDetalle":
  $objMaestro=new Maestro($idMaestro,'');

 $objCtrMaestro =new CtrMaestro($objMaestro);
 $objMaestro=$objCtrMaestro->consultar();
 $idMaestro= $objMaestro->getIdMaestro();
 $nombre= $objMaestro->getNombre();

   $objDetalle=new Detalle('',$idMaestro);
    $objCtrDetalle =new CtrDetalle($objDetalle);
   $matrizDetalles= $objCtrDetalle->consultarDetalles();

   $nuevoDetalle=true;
 break;

}


}
catch(Exception  $objEx){
 echo "ERROR : ".$objEx->getMessage()."\n";
}

echo "
<HTML>
<HEAD>
</HEAD>
<BODY>
<FORM NAME =\"FRMMAESTRODETALLE\" ACTION =\"vistaMaestroDetalle.php\" METHOD =\"POST\">
<TABLE>
<TR>
<TD>IDMAESTRO</TD><TD><INPUT TYPE =\"TEXT\" NAME=\"txtIdMaestro\" VALUE=\"".$idMaestro."\" ></TD>
</TR>
<TR>
<TD>NOMBRE</TD><TD><INPUT TYPE =\"TEXT\" NAME=\"txtNombre\" VALUE=\"".$nombre."\" ></TD>
</TR>
<TR>
<TD><INPUT TYPE =\"SUBMIT\" NAME=\"boton\" VALUE=\"Guardar\" ></TD>
<TD><INPUT TYPE =\"SUBMIT\" NAME=\"boton\" VALUE=\"Consultar\" ></TD>
<TD><INPUT TYPE =\"SUBMIT\" NAME=\"boton\" VALUE=\"AgregarDetalle\" ></TD>
</TR>
</TABLE>
</FORM>
<TABLE>";
for($i=1;$i<=$matrizDetalles[0][0];$i++){
echo"
<TR>
<TD><INPUT TYPE =\"TEXT\" NAME =\"ID[$i]\" VALUE = \"".$matrizDetalles[$i][0]."\"></TD>
<TD><INPUT TYPE =\"TEXT\" NAME =\"DATO[$i]\" VALUE = \"".$matrizDetalles[$i][1]."\"></TD>
<TD><INPUT TYPE =\"TEXT\" NAME =\"IDMAESTRO[$i]\" VALUE = \"".$matrizDetalles[$i][2]."\"></TD>

</TR>
";
}
if($nuevoDetalle==true){
		$n=$matrizDetalles[0][0]+1;
echo"
<TR>
<TD><INPUT TYPE =\"TEXT\" NAME =\"ID[$i+1]\" VALUE = \"".$n."\"></TD>
<TD><INPUT TYPE =\"TEXT\" NAME =\"DATO[$i+1]\" VALUE = \"0\"></TD>
<TD><INPUT TYPE =\"TEXT\" NAME =\"IDMAESTRO[$i+1]\" VALUE = \"".$idMaestro."\"></TD>

</TR>
";
$nuevoDetalle=false;
}
echo"
</TABLE>

</BODY>
</HTML>
";

?>
