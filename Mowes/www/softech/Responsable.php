<?php
include ("Includes/header.php");
include("./Modelo/Responsable.php");
include("./Control/CtrResponsable.php");
include("./Control/CtrConexion.php");

	    $ID_RESP="";
        $NOMB_RESP="";
        $APELL_RESP="";
        $EMAIL_RESP="";
        $TEL_RESP="";
        $CEL_RESP="";
        $CARGO_RESP="";
        $COUNTUSER_RESP="";
        $PASSWORD_RESP="";
        $FOTO_RESP="";
        $boton="";
        $ArrayResponsable = null;
        $x="";
        $cont=0;
        $tam=0;

  try{

        $ID_RESP=$_POST["txtid"];
        $NOMB_RESP=$_POST["txtnombre"];
        $APELL_RESP=$_POST["txtapellido"];
        $EMAIL_RESP=$_POST["txtemail"];
        $TEL_RESP=$_POST["txttelefono"];
        $CEL_RESP=$_POST["txtcelular"];
        $CARGO_RESP=$_POST["txtcargo"];
        $COUNTUSER_RESP=$_POST["txtcuentaresponsable"];
        $PASSWORD_RESP=$_POST["txtcontrasena"];
        $FOTO_RESP=$_POST["txtfoto"];
        $boton=$_POST["enviar"];

        if($boton =="Insertar"){
    	    $objResponsable=new Responsable($ID_RESP,$NOMB_RESP,$APELL_RESP,$EMAIL_RESP,$TEL_RESP,
            $CEL_RESP,$CARGO_RESP,$COUNTUSER_RESP,$PASSWORD_RESP,$FOTO_RESP);

    	    $objCtrResponsable=new CtrResponsable($objResponsable);
    	    $objCtrResponsable->guardar();

             $ID_RESP=$objResponsable->getID_RESP();
             $NOMB_RESP=$objResponsable->getNOMB_RESP();
             $APELL_RESP=$objResponsable->getAPELL_RESP();
             $EMAIL_RESP=$objResponsable->getEMAIL_RESP();
             $TEL_RESP=$objResponsable->getTEL_RESP();
             $CEL_RESP=$objResponsable->getCEL_RESP();
             $CARGO_RESP=$objResponsable->getCARGO_RESP();
             $COUNTUSER_RESP=$objResponsable->getCOUNTUSER_RESP();
             $PASSWORD_RESP=$objResponsable->getPASSWORD_RESP();
             $FOTO_RESP=$objResponsable->getFOTO_RESP();

             header("location: Responsable.php");
        }

   if($boton =="Actualizar"){
    	    $objResponsable=new Responsable($ID_RESP,$NOMB_RESP,$APELL_RESP,$EMAIL_RESP,$TEL_RESP,
            $CEL_RESP,$CARGO_RESP,$COUNTUSER_RESP,$PASSWORD_RESP,$FOTO_RESP);
    	    $objCtrResponsable=new CtrResponsable($objResponsable);
    	    $objCtrResponsable->modificar();

             $ID_RESP=$objResponsable->getID_RESP();
             $NOMB_RESP=$objResponsable->getNOMB_RESP();
             $APELL_RESP=$objResponsable->getAPELL_RESP();
             $EMAIL_RESP=$objResponsable->getEMAIL_RESP();
             $TEL_RESP=$objResponsable->getTEL_RESP();
             $CEL_RESP=$objResponsable->getCEL_RESP();
             $CARGO_RESP=$objResponsable->getCARGO_RESP();
             $COUNTUSER_RESP=$objResponsable->getCOUNTUSER_RESP();
             $PASSWORD_RESP=$objResponsable->getPASSWORD_RESP();
             $FOTO_RESP=$objResponsable->getFOTO_RESP();

             header("location: Responsable.php");
    }


   if($boton =="Consultar"){

             $objResponsable=new Responsable($ID_RESP,"","","","","","","","","","");
             $objCtrResponsable =new CtrResponsable($objResponsable);
             $objResponsable = $objCtrResponsable->consultar();
             $NOMB_RESP=$objResponsable->getNOMB_RESP();
             $APELL_RESP=$objResponsable->getAPELL_RESP();
             $EMAIL_RESP=$objResponsable->getEMAIL_RESP();
             $TEL_RESP=$objResponsable->getTEL_RESP();
             $CEL_RESP=$objResponsable->getCEL_RESP();
             $CARGO_RESP=$objResponsable->getCARGO_RESP();
             $COUNTUSER_RESP=$objResponsable->getCOUNTUSER_RESP();
             $PASSWORD_RESP=$objResponsable->getPASSWORD_RESP();
             $FOTO_RESP=$objResponsable->getFOTO_RESP();

    }

   if($boton =="Eliminar"){
             $objResponsable=new Responsable($ID_RESP,"","","","","","","","","","");
             $objCtrResponsable =new CtrResponsable($objResponsable);
    	     $objCtrResponsable->eliminar();

             header("location: Responsable.php");
    }

   if($boton =="Listar Responsables"){
             $objResponsable=new Responsable("","","","","","","","","","","");
             $objCtrResponsable =new CtrResponsable($objResponsable);
             $ArrayResponsable = $objCtrResponsable->listar();
             $tam = $ArrayResponsable[0][0];
     }

  }
      	catch (Exception $exp)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
        }
?>
<style type="text/css">
<!--
.Estilo3 {	font-size: 40px
}
.Estilo4 {	font-size: 16px;
	font-weight: bold;
}
#apDiv14 {	position:absolute;
	width:242px;
	height:234px;
	z-index:4;
	left: 772px;
	top: 122px;
}
#apDiv15 {
	position:absolute;
	width:459px;
	height:43px;
	z-index:4;
	left: 581px;
	top: 45px;
}
.Estilo5 {font-family: Fixedsys}
-->
</style>

<form id="formResponsable" action="Responsable.php" method="post">
<div align="center">
  <table width="1032" height="383" border="0">
    <tr>
      <td height="83" colspan="6"><div align="center" class="Estilo3">
        <div align="center" class="Estilo5">FORMULARIO RESPONSABLE</div>
        </div></td>
    </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="320" rowspan="8"><img src="imagenes/Fotos/Responsable/<?php echo $FOTO_RESP; ?>" alt="" width="280" height="232" /></td>
    </tr>
    <tr>
      <td height="29"><div align="left"><span class="Estilo4">Documento de Identidad</span></div></td>
      <td><input name="txtid" id="txtid" value="<?php echo $ID_RESP; ?>" size="25" ></td>
      <td width="95">&nbsp;</td>
      <td width="168">&nbsp;</td>
      <td width="47">&nbsp;</td>
    </tr>
    <tr>
      <td width="183" height="29" class="Estilo4"><div align="left">Nombres</div></td>
      <td width="193"><input name="txtnombre" id="txtnombre" value="<?php echo $NOMB_RESP; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="28" class="Estilo4"><div align="left">Apellidos</div></td>
      <td><input name="txtapellido" id="txtapellido" value="<?php echo $APELL_RESP; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Correo Electr&oacute;nico</div></td>
      <td width="193"><input name="txtemail" type="text" id="txtemail" value="<?php echo $EMAIL_RESP; ?>" size="25" ></td>
      <td height="29" class="Estilo4"><div align="left">Imagen</div></td>
      <td><input name="txtfoto" type="text" id="txtfoto" value="<?php echo $FOTO_RESP; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Tel&eacute;fono</div></td>
      <td><input name="txttelefono" type="text" id="txttelefono" value="<?php echo $TEL_RESP; ?>" size="25" ></td>
      <td class="Estilo4"><div align="left">Celular</div></td>
      <td><input name="txtcelular" type="text" id="txtcelular" value="<?php echo $CEL_RESP; ?>" size="25" ></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Cargo</div></td>
      <td><input name="txtcargo" type="text" id="txtcargo" value="<?php echo $CARGO_RESP; ?>" size="25" ></td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Cuenta Responsable</div></td>
      <td><input name="txtcuentaresponsable" type="text" id="txtcuentaresponsable" value="<?php echo $COUNTUSER_RESP; ?>" size="25" ></td>
      <td class="Estilo4"><div align="left">Contrase&ntilde;a</div></td>
      <td><input name="txtcontrasena" type="text" id="txtcontrasena" value="<?php echo $PASSWORD_RESP; ?>" size="25" ></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div align="center" class="Estilo3">
    <div align="center" class="Estilo5"></div>
  </div>
  <table border="0" align="center" cellspacing="30">
    <tr>
      <td width="102" height="58"><span class="Estilo5">
        <input name="enviar" type="submit" class="Estilo4" id="btnconsultar" value="Consultar" />
      </span></td>
      <td width="6">-</td>
      <td width="86"><a href="<?php echo $raiz; ?>Usuario.php">
        <input name="enviar" type="submit" class="Estilo4" id="btninsertar" value="Insertar" />
      </a></td>
      <td width="6">-</td>
      <td width="103"><a href="<?php echo $raiz; ?>Incidente.php">
        <input name="enviar" type="submit" class="Estilo4" id="btnactualizar" value="Actualizar" />
      </a></td>
      <td width="6">-</td>
      <td width="87"><a href="<?php echo $raiz; ?>Responsable.php">
        <input name="enviar" type="submit" class="Estilo4" id="btneliminar" value="Eliminar" />
      </a></td>
      <td width="6">-</td>
      <td width="86"><a href="<?php echo $raiz; ?>Responsable.php">
        <input name="enviar" type="submit" class="Estilo4" id="btnlistar" value="Listar Responsables" />
      </a></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</div>
<p>&nbsp;</p>
<div align="center"></div>
</div>
</form>


<?php
          $x="<center><table border='1' ><tr><td>Identificacion</td><td>Nombre</td><td>Apellido</td><td>Email</td><td>Telefono</td><td>Celular</td><td>Cargo</td><td>Cuenta Usuario</td><td>Password</td></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayResponsable[$cont][0]."</td><td>".$ArrayResponsable[$cont][1]."</td><td>".$ArrayResponsable[$cont][2]."</td><td>".$ArrayResponsable[$cont][3]."</td><td>".$ArrayResponsable[$cont][4]."</td><td>".$ArrayResponsable[$cont][5]."</td>
                    <td>".$ArrayResponsable[$cont][6]."</td><td>".$ArrayResponsable[$cont][7]."</td><td>".$ArrayResponsable[$cont][8]."</td><td>".$ArrayResponsable[$cont][9]."</td></tr>";
              }
              $x=$x."</table></center>";
              echo $x;
include ("Includes/footer.php");
?>
