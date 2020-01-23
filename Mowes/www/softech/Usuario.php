<?php
include ("Includes/header.php");
include("./Modelo/Usuario.php");
include("./Control/CtrUsuario.php");
include("./Control/CtrConexion.php");

	    $ID_USER="";
        $NOMB_USER="";
        $APELL_USER="";
        $EMAIL_USER="";
        $TEL_USER="";
        $CEL_USER="";
        $DIR_USER="";
        $COUNTUSER_USER="";
        $PASSWORD_USER="";
        $FKCIUDAD="";
        $FOTO_USER="";
        $boton="";
        $ArrayUsuario = null;
        $x="";
        $cont=0;
        $tam=0;

  try{

        $ID_USER=$_POST["txtid"];
        $NOMB_USER=$_POST["txtnombre"];
        $APELL_USER=$_POST["txtapellido"];
        $EMAIL_USER=$_POST["txtemail"];
        $TEL_USER=$_POST["txttelefono"];
        $CEL_USER=$_POST["txtcelular"];
        $DIR_USER=$_POST["txtdireccion"];
        $COUNTUSER_USER=$_POST["txtcuentausuario"];
        $PASSWORD_USER=$_POST["txtcontrasena"];
        $FKCIUDAD=$_POST["txtciudad"];
        $FOTO_USER=$_POST["txtfoto"];
        $boton=$_POST["enviar"];

        if($boton =="Insertar"){
    	    $objUsuario=new Usuario($ID_USER,$NOMB_USER,$APELL_USER,$EMAIL_USER,$TEL_USER,
            $CEL_USER,$DIR_USER,$COUNTUSER_USER,$PASSWORD_USER,$FKCIUDAD,$FOTO_USER);

    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->guardar();

             $ID_USER=$objUsuario->getID_USER();
             $NOMB_USER=$objUsuario->getNOMB_USER();
             $APELL_USER=$objUsuario->getAPELL_USER();
             $EMAIL_USER=$objUsuario->getEMAIL_USER();
             $TEL_USER=$objUsuario->getTEL_USER();
             $CEL_USER=$objUsuario->getCEL_USER();
             $DIR_USER=$objUsuario->getDIR_USER();
             $COUNTUSER_USER=$objUsuario->getCOUNTUSER_USER();
             $PASSWORD_USER=$objUsuario->getPASSWORD_USER();
             $FKCIUDAD=$objUsuario->getFKCIUDAD();
             $FOTO_USER=$objUsuario->getFOTO_USER();

             header("location: Usuario.php");
        }

   if($boton =="Actualizar"){
    	    $objUsuario=new Usuario($ID_USER,$NOMB_USER,$APELL_USER,$EMAIL_USER,$TEL_USER,
            $CEL_USER,$DIR_USER,$COUNTUSER_USER,$PASSWORD_USER,$FKCIUDAD,$FOTO_USER);
    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->modificar();

             $NOMB_USER=$objUsuario->getNOMB_USER();
             $APELL_USER=$objUsuario->getAPELL_USER();
             $EMAIL_USER=$objUsuario->getEMAIL_USER();
             $TEL_USER=$objUsuario->getTEL_USER();
             $CEL_USER=$objUsuario->getCEL_USER();
             $DIR_USER=$objUsuario->getDIR_USER();
             $COUNTUSER_USER=$objUsuario->getCOUNTUSER_USER();
             $PASSWORD_USER=$objUsuario->getPASSWORD_USER();
             $FKCIUDAD=$objUsuario->getFKCIUDAD();
             $FOTO_USER=$objUsuario->getFOTO_USER();

             header("location: Usuario.php");
    }


   if($boton =="Consultar"){

             $objUsuario=new Usuario($ID_USER,"","","","","","","","","","","");
             $objCtrUsuario =new CtrUsuario($objUsuario);
             $objUsuario = $objCtrUsuario->consultar();
             $NOMB_USER=$objUsuario->getNOMB_USER();
             $APELL_USER=$objUsuario->getAPELL_USER();
             $EMAIL_USER=$objUsuario->getEMAIL_USER();
             $TEL_USER=$objUsuario->getTEL_USER();
             $CEL_USER=$objUsuario->getCEL_USER();
             $DIR_USER=$objUsuario->getDIR_USER();
             $COUNTUSER_USER=$objUsuario->getCOUNTUSER_USER();
             $PASSWORD_USER=$objUsuario->getPASSWORD_USER();
             $FOTO_USER=$objUsuario->getFOTO_USER();
             $FKCIUDAD=$objUsuario->getFKCIUDAD();

    }

   if($boton =="Eliminar"){
             $objUsuario=new Usuario($ID_USER,"","","","","","","","","","","");
             $objCtrUsuario =new CtrUsuario($objUsuario);
    	     $objCtrUsuario->eliminar();

             header("location: Usuario.php");
    }

   if($boton =="Listar Usuarios"){
             $objUsuario=new Usuario("","","","","","","","","","","","");
             $objCtrUsuario =new CtrUsuario($objUsuario);
             $ArrayUsuario = $objCtrUsuario->listar();
             $tam = $ArrayUsuario[0][0];
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
<script language="JavaScript" src="validar.js"> </script>
<script language="javascript" type="text/javascript">
function validar(){
if (document.formUsuario.txtid.value.length==0){
alert("Debe ingresar el Usuario")
}

}
</script>
<form id="formUsuario" action="Usuario.php" method="post">
<div align="center">
  <table width="1032" height="383" border="0">
    <tr>
      <td height="83" colspan="6"><div align="center" class="Estilo3">
        <div align="center" class="Estilo5">FORMULARIO USUARIO</div>
        </div></td>
    </tr>
    <tr>
      <td height="29">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="320" rowspan="8"><img src="imagenes/Fotos/Usuario/<?php echo $FOTO_USER; ?>" alt="" width="280" height="232" /></td>
    </tr>
    <tr>
      <td height="29"><div align="left"><span class="Estilo4">Documento de Identidad</span></div></td>
      <td><input name="txtid" id="txtid" value="<?php echo $ID_USER; ?>" size="25" ></td>
      <td width="95">&nbsp;</td>
      <td width="168">&nbsp;</td>
      <td width="47">&nbsp;</td>
    </tr>
    <tr>
      <td width="183" height="29" class="Estilo4"><div align="left">Nombres</div></td>
      <td width="193"><input name="txtnombre" id="txtnombre" value="<?php echo $NOMB_USER; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="28" class="Estilo4"><div align="left">Apellidos</div></td>
      <td><input name="txtapellido" id="txtapellido" value="<?php echo $APELL_USER; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Correo Electr&oacute;nico</div></td>
      <td width="193"><input name="txtemail" type="text" id="txtemail" value="<?php echo $EMAIL_USER; ?>" size="25" ></td>
      <td height="29" class="Estilo4"><div align="left">Imagen</div></td>
      <td><input name="txtfoto" type="text" id="txtfoto" value="<?php echo $FOTO_USER; ?>" size="25" ></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Tel&eacute;fono</div></td>
      <td><input name="txttelefono" type="text" id="txttelefono" value="<?php echo $TEL_USER; ?>" size="25" ></td>
      <td class="Estilo4"><div align="left">Celular</div></td>
      <td><input name="txtcelular" type="text" id="txtcelular" value="<?php echo $CEL_USER; ?>" size="25" ></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Direcci&oacute;n</div></td>
      <td><input name="txtdireccion" type="text" id="txtdireccion" value="<?php echo $DIR_USER; ?>" size="25" ></td>
      <td height="29" class="Estilo4"><div align="left">Ciudad</div></td>
      <td><input name="txtciudad" type="text" id="txtciudad" value="<?php echo $FKCIUDAD; ?>" size="25" ></td>
    </tr>
    <tr>
      <td height="29" class="Estilo4"><div align="left">Cuenta Usuario</div></td>
      <td><input name="txtcuentausuario" type="text" id="txtcuentausuario" value="<?php echo $COUNTUSER_USER; ?>" size="25" ></td>
      <td class="Estilo4"><div align="left">Contrase&ntilde;a</div></td>
      <td><input name="txtcontrasena" type="text" id="txtcontrasena" value="<?php echo $PASSWORD_USER; ?>" size="25" ></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <div align="center" class="Estilo3">
    <div align="center" class="Estilo5"></div>
  </div>
  <table border="0" align="center" cellspacing="30">
    <tr>
      <td width="102" height="58"><span class="Estilo5">
        <input name="enviar" type="submit" onclick="validar()"class="Estilo4" id="btnconsultar" value="Consultar" />
      </span></td>
      <td width="6">-</td>
      <td width="86"><a href="<?php echo $raiz; ?>Usuario.php">
        <input name="enviar" type="submit" onclick="validar_formulario_cliente()"class="Estilo4" id="btninsertar" value="Insertar" />
      </a></td>
      <td width="6">-</td>
      <td width="103"><a href="<?php echo $raiz; ?>Incidente.php">
        <input name="enviar" type="submit" onclick="validar_formulario_cliente()"class="Estilo4" id="btnactualizar" value="Actualizar" />
      </a></td>
      <td width="6">-</td>
      <td width="87"><a href="<?php echo $raiz; ?>Tecnico.php">
        <input name="enviar" type="submit" onclick="validar_formulario_cliente()"class="Estilo4" id="btneliminar" value="Eliminar" />
      </a></td>
      <td width="6">-</td>
      <td width="86"><a href="<?php echo $raiz; ?>Usuario.php">
        <input name="enviar" type="submit" onclick="validar_formulario_cliente()"class="Estilo4" id="btnlistar" value="Listar Usuarios" />
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
          $x="<center><table border='1' ><tr><td>Identificacion</td><td>Nombre</td><td>Apellido</td><td>Email</td><td>Telefono</td><td>Celular</td><td>Direccion</td><td>Cuenta Usuario</td><td>Password Usuario</td><td>Ciudad</td><td>Foto</td></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayUsuario[$cont][0]."</td><td>".$ArrayUsuario[$cont][1]."</td><td>".$ArrayUsuario[$cont][2]."</td><td>".$ArrayUsuario[$cont][3]."</td><td>".$ArrayUsuario[$cont][4]."</td><td>".$ArrayUsuario[$cont][5]."</td>
                    <td>".$ArrayUsuario[$cont][6]."</td><td>".$ArrayUsuario[$cont][7]."</td><td>".$ArrayUsuario[$cont][8]."</td><td>".$ArrayUsuario[$cont][9]."</td><td>".$ArrayUsuario[$cont][10]."</td></tr>";
              }
              $x=$x."</table></center>";
              echo $x;
include ("Includes/footer.php");
?>
