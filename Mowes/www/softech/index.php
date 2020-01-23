<?php

include ("Includes/header_login.php");

?>
<style type="text/css">
<!--
.Estilo4 {	font-size: 36px;
	font-weight: bold;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #0000CC;
}
.Estilo3 {font-size: 18px}
#apDiv4 {
	position:absolute;
	width:83px;
	height:40px;
	z-index:4;
	left: 441px;
	top: 271px;
}
#apDiv1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:5;
}
#apDiv2 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
}
-->
</style>

<script language="JavaScript" src="validar.js"> </script>
<script language="javascript" type="text/javascript">
function valida(){
if (document.frmLogin.txtusuario.value.length==0){
alert("Debe ingresar el Usuario")
}
if (document.frmLogin.txtcontrasena.value.length==0){
alert("Debe ingresar la contraseña")
}
}
</script>
<form name="frmLogin" action="login.php" method="post">
<table>
  <tr>
   <td><table>
   <tr>
     <td width="243" height="88">&nbsp;</td>
     <td colspan="2" bordercolor="4"><div align="center">
       <div align="center"><span class="Estilo4">INGRESAR</span><br />
       </div>
       </div></td>
     <td width="361" bordercolor="0">&nbsp;</td>
    </tr>
    <tr>
      <td height="56" class="texto">&nbsp;</td>
      <td width="202" bordercolor="4" class="texto"><div align="center" class="Estilo3">Usuario</div></td>
      <td width="286" bordercolor="4" class="texto"><input name="txtusuario" type="text" id="txtusuario" size="30" /></td>
    <td bordercolor="0" class="texto">&nbsp;</td>
    </tr>
    <tr>
      <td height="49">&nbsp;</td>
      <td width="202" bordercolor="4"><div align="center"><span class="Estilo3">Contraseña</span></div></td>
      <td bordercolor="4"><input name="txtcontrasena" type="password" id="txtcontrasena" size="30" /></td>
    <td bordercolor="0">&nbsp;</td>
    </tr>
    <tr>
      <td class="texto">&nbsp;</td>
      <td colspan="2" bordercolor="4" class="texto">&nbsp;</td>
      <td bordercolor="0" class="texto">&nbsp;</td>
    </tr>
    <tr>
      <td class="texto">&nbsp;</td>
      <td colspan="2" bordercolor="4" class="texto"><div align="center">
        <input name="btnenviar" type="submit" onclick="valida()"class="Estilo3" id="btnenviar" value="enviar" />
      </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p></td>
      <td bordercolor="0" class="texto">&nbsp;</td>
    </tr>
   </table>
   </td>
   <td rowspan="3"><br /><br />
   <img src="Imagenes/publicidad.png" height="275" />
   <div id="verPlanes"></div>
   </td>
  </tr>
 </table>
 </form>
<?php
include ("Includes/footer_login.php");
?>
