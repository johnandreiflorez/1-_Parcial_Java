<?php
include("../modelo/Vivienda.php");
include("../modelo/Cliente.php");
include("../control/CtrCliente.php");
include("../control/CtrVivienda.php");
include("../control/CtrConexion.php");




//Definición de Variables
 $idVivienda =0;
 $direcion= "";
 $telefono=  "";
 $tipo= "C"; //C: Casa; A: Apartamento; O: Otra
 $fkCliente=0;
 $boton= "";

 $vectorIdClientes=null;
 $objCliente= new Cliente('','','');
 $objCtrCliente= new CtrCliente($objCliente);
 $vectorIdClientes=$objCtrCliente->listarComboFkCliente();


try{
 $idVivienda=$_POST["txtIdVivienda"];
 $direcion=$_POST["txtDireccion"];
 $telefono=$_POST["txtTelefono"];
 $tipo=$_POST["lstTipos"];


 $fkCliente=$_POST["lstCodClientes"];


 $boton=$_POST["boton"];

switch($boton){
 case "Guardar":
             $objVivienda=new Vivienda($idVivienda,$direcion,$telefono,$tipo,$fkCliente);
             $objCtrVivienda =new CtrVivienda($objVivienda);
             $objCtrVivienda->guardar();
 break;
 case "Consultar":
             $objVivienda=new Vivienda($idVivienda,'','','','');
             $objCtrVivienda =new CtrVivienda($objVivienda);
             $objVivienda=$objCtrVivienda->consultar();

             $idVivienda=$objVivienda->getIdVivienda();
             $direcion = $objVivienda->getDirecion();
             $telefono = $objVivienda->getTelefono();
             $tipo =     $objVivienda->getTipo();
             $fkCliente= $objVivienda->getFkCliente();


 break;
 case "Modificar":

 break;
 case "Borrar":

 break;
}

}
catch(Exception  $objEx){
 echo "ERROR : ".$objEx->getMessage()."\n";
}

echo "
<html><head>
  <meta content=\"text/html; charset=ISO-8859-1\" http-equiv=\"content-type\">
  <title>vistaViviendas</title>
</head><body>
<form method=\"post\" action=\"vistaViviendas.php\" name=\"frmVivienda\">
<br>
<table style=\"text-align: left; width: 100%;\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr>
      <td colspan=\"3\" rowspan=\"1\" style=\"vertical-align: top; text-align: center; width: 434px;\"><span style=\"font-weight: bold;\">VIVIENDA</span><br>
      </td>
    </tr>
    <tr>
      <td style=\"vertical-align: top; width: 291px;\"><span style=\"font-weight: bold;\">IDENTIFICACIÓN</span><br>
      </td>
      <td style=\"vertical-align: top; width: 317px;\"><input name=\"txtIdVivienda\" value= \" ".$idVivienda." \"><br>
      </td>
      <td colspan=\"1\" rowspan=\"4\" style=\"vertical-align: top; width: 434px;\"><br>
      <br>
      <img style=\"width: 259px; height: 194px;\" alt=\"vivienda\" src=\"imagenes/vivienda2.jpg\"><br>
      <br>
      </td>
    </tr>
    <tr>
      <td style=\"vertical-align: top; width: 291px;\"><span style=\"font-weight: bold;\">DIRECCIÓN</span><br>
      </td>
      <td style=\"vertical-align: top; width: 317px;\"><input name=\"txtDireccion\" value=\" ".$direcion." \"><br>
      </td>
    </tr>
    <tr>
      <td style=\"vertical-align: top; width: 291px;\"><span style=\"font-weight: bold;\">Tipo</span><br>
      </td>
      <td style=\"vertical-align: top; width: 317px;\">
        <select name=\"lstTipos\">
        <option>C</option>
        <option>A</option>
        <option>O</option>
       </select>
      </td>
    </tr>
    <tr>
      <td style=\"vertical-align: top; width: 291px;\"><span style=\"font-weight: bold;\">TELEFONO</span><br>
      </td>
     <td style=\"vertical-align: top; width: 317px;\"><input name=\"txtTelefono\" value = \" ".$telefono." \">
      </td>
    </tr>
    <tr>
      <td style=\"vertical-align: top; width: 291px;\"><span style=\"font-weight: bold;\">CÓDIGO CLIENTE</span><br>
      </td>
      <td style=\"vertical-align: top; width: 317px;\">

        <select name=\"lstCodClientes\">";

        for($i=1;$i<= $vectorIdClientes[0];$i++){
         echo "<option>".$vectorIdClientes[$i]."</option>";
        }
  echo"
         </select>

      </td>
    </tr>
  </tbody>
</table>
  <br>
  <table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
    <tbody>
      <tr>
        <td style=\"vertical-align: top; width: 358px;\"><input name=\"boton\" value=\"Guardar\" type=\"submit\"><br>
        </td>
        <td style=\"vertical-align: top; width: 270px;\"><input name=\"boton\" value=\"Consultar\" type=\"submit\"><br>
        </td>
        <td style=\"vertical-align: top; width: 213px;\"><input name=\"boton\" value=\"Modificar\" type=\"submit\"><br>
        </td>
        <td style=\"vertical-align: top; width: 193px;\"><input name=\"boton\" value=\"Borrar\" type=\"submit\"><br>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
<br>
</form>
</body></html>
";

?>