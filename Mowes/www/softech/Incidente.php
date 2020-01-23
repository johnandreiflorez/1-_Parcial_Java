<?php
include ("Includes/header.php");
include("./Modelo/Incidente.php");
include("./Control/CtrIncidente.php");
include("./Control/CtrConexion.php");

	    $COD_INCID="";
        $DESC_INCID="";
        $FECHAREGIS_INCID="";
        $FECHASOLUC_INCID="";
        $FKUSUARIO="";
        $FKPRIORIDAD="";
        $FKESTADO="";
        $FKCATEGORIA="";
        $FKRESPONSABLE="";
        $boton="";
        $ArrayUsuario = null;
        $x="";
        $cont=0;
        $tam=0;

  try{

        $COD_INCID=$_POST["txtid"];
        $DESC_INCID=$_POST["txtdescripcion"];
        $FECHAREGIS_INCID=$_POST["txtfecharegistro"];
        $FECHASOLUC_INCID=$_POST["txtfechasolucion"];
        $FKUSUARIO=$_POST["txtusuario"];
        $FKPRIORIDAD=$_POST["txtprioridad"];
        $FKESTADO=$_POST["txtestado"];
        $FKCATEGORIA=$_POST["txtcategoria"];
        $FKRESPONSABLE=$_POST["txtresponsable"];
        $boton=$_POST["enviar"];

        if($boton =="Insertar"){
    	    $objIncidente=new Incidente($COD_INCID,$DESC_INCID,$FECHAREGIS_INCID,$FECHASOLUC_INCID,$FKUSUARIO,
            $FKPRIORIDAD,$FKESTADO,$FKCATEGORIA,$FKRESPONSABLE);

    	    $objCtrIncidente=new CtrIncidente($objIncidente);
    	    $objCtrIncidente->guardar();

             $COD_INCID=$objIncidente->getCOD_INCID();
             $DESC_INCID=$objIncidente->getDESC_INCID();
             $FECHAREGIS_INCID=$objIncidente->getFECHAREGIS_INCID();
             $FECHASOLUC_INCID=$objIncidente->getFECHASOLUC_INCID();
             $FKUSUARIO=$objIncidente->getFKUSUARIO();
             $FKPRIORIDAD=$objIncidente->getFKPRIORIDAD();
             $FKESTADO=$objIncidente->getFKESTADO();
             $FKCATEGORIA=$objIncidente->getFKCATEGORIA();
             $FKRESPONSABLE=$objIncidente->getFKRESPONSABLE();

             header("location: Incidente.php");
        }

   if($boton =="Actualizar"){
    	    $objIncidente=new Incidente($COD_INCID,$DESC_INCID,$FECHAREGIS_INCID,$FECHASOLUC_INCID,$FKUSUARIO,
            $FKPRIORIDAD,$FKESTADO,$FKCATEGORIA,$FKRESPONSABLE);
    	    $objCtrIncidente=new CtrIncidente($objIncidente);
    	    $objCtrIncidente->modificar();

             $DESC_INCID=$objIncidente->getDESC_INCID();
             $FECHAREGIS_INCID=$objIncidente->getFECHAREGIS_INCID();
             $FECHASOLUC_INCID=$objIncidente->getFECHASOLUC_INCID();
             $FKUSUARIO=$objIncidente->getFKUSUARIO();
             $FKPRIORIDAD=$objIncidente->getFKPRIORIDAD();
             $FKESTADO=$objIncidente->getFKESTADO();
             $FKCATEGORIA=$objIncidente->getFKCATEGORIA();
             $FKRESPONSABLE=$objIncidente->getFKRESPONSABLE();

             header("location: Incidente.php");
    }


   if($boton =="Consultar"){

             $objIncidente=new Incidente($COD_INCID,"","","","","","","","");
             $objCtrIncidente =new CtrIncidente($objIncidente);
             $objIncidente = $objCtrIncidente->consultar();
             $DESC_INCID=$objIncidente->getDESC_INCID();
             $FECHAREGIS_INCID=$objIncidente->getFECHAREGIS_INCID();
             $FECHASOLUC_INCID=$objIncidente->getFECHASOLUC_INCID();
             $FKUSUARIO=$objIncidente->getFKUSUARIO();
             $FKPRIORIDAD=$objIncidente->getFKPRIORIDAD();
             $FKESTADO=$objIncidente->getFKESTADO();
             $FKCATEGORIA=$objIncidente->getFKCATEGORIA();
             $FKRESPONSABLE=$objIncidente->getFKRESPONSABLE();

    }

   if($boton =="Eliminar"){
             $objIncidente=new Incidente($COD_INCID,"","","","","","","","");
             $objCtrIncidente =new CtrIncidente($objIncidente);
    	     $objCtrIncidente->eliminar();

             header("location: Incidente.php");
    }

   if($boton =="Listar Incidentes"){
             $objIncidente=new Incidente("","","","","","","","","");
             $objCtrIncidente =new CtrIncidente($objIncidente);
             $ArrayIncidente = $objCtrIncidente->listar();
             $tam = $ArrayIncidente[0][0];
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

<form id="formIncidente" action="Incidente.php" method="post">
<div align="center">
  <table width="998" height="348" border="0">
    <tr>
      <td height="83" colspan="8"><div align="center" class="Estilo3">
        <div align="center" class="Estilo5">INCIDENTES</div>
        </div></td>
    </tr>
    <tr>
      <td height="29"><div align="left" class="Estilo3"><span class="Estilo4">CODIGO:</span></div></td>
      <td class="Estilo4"><input name="txtid" type="text" class="Estilo4" id="txtid align="center"" value="<?php echo $COD_INCID; ?>" size="10" /></td>
      <td colspan="2" class="Estilo4"><div align="center">Cedula Usuario</div></td>
      <td colspan="2" class="Estilo4"><input name="txtusuario" type="text" id="txtusuario" value="<?php echo $FKUSUARIO; ?>" size="25" /></td>
      <td>&nbsp;</td>
      <td width="29" rowspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td width="114" rowspan="2"><div align="left" class="Estilo4">Descripci&oacute;n</div></td>
      <td colspan="5" rowspan="2"><label>
      <textarea name="txtdescripcion" cols="80" rows="5" id="txtdescripcion"><?php echo $DESC_INCID; ?></textarea>
      </label></td>
      <td width="164" height="29">&nbsp;</td>
    </tr>
    <tr>
      <td height="31">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" class="Estilo4"><div align="left">Fecha Registro</div></td>
      <td colspan="2"><input name="txtfecharegistro" id="txtfecharegistro" value="<?php echo $FECHAREGIS_INCID; ?>" size="25" /></td>
      <td><div align="left" class="Estilo4">Fecha Soluci&oacute;n</div></td>
      <td colspan="2"><input name="txtfechasolucion" id="txtfechasolucion" value="<?php echo $FECHASOLUC_INCID; ?>" size="25" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4">Prioridad</td>
      <td width="178"><input name="txtprioridad" id="txtprioridad" value="<?php echo $FKPRIORIDAD; ?>" size="25" /></td>
      <td width="72"><span class="Estilo4">Estado</span></td>
      <td width="166"><input name="txtestado" id="txtestado" value="<?php echo $FKESTADO; ?>" size="25" /></td>
      <td width="73" height="29" class="Estilo4">Categor&iacute;a</td>
      <td width="150"><input name="txtcategoria" id="txtcategoria" value="<?php echo $FKCATEGORIA; ?>" size="25" /></td>
      <td>&nbsp;</td>
      <td width="26">&nbsp;</td>
      <td width="33">&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="Estilo4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" colspan="2" class="Estilo4"><div align="center">Cedula Responsable</div></td>
      <td colspan="2"><input name="txtresponsable" id="txtresponsable" value="<?php echo $FKRESPONSABLE; ?>" size="25" /></td>
      <td height="29" class="Estilo4">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="29" class="Estilo4">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="Estilo4">&nbsp;</td>
      <td>&nbsp;</td>
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
      <td width="86"><a href="<?php echo $raiz; ?>Usuario.php">
        <input name="enviar" type="submit" class="Estilo4" id="btnlistar" value="Listar Incidentes" />
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
          $x="<center><table border='1' ><tr><td>Codigo</td><td>Descripcion</td><td>Fecha Registro</td><td>Fecha Solucion</td><td>Id Usuario</td><td>Prioridad</td><td>Estado</td><td>Categoria</td><td>Responsable</td></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayIncidente[$cont][0]."</td><td>".$ArrayIncidente[$cont][1]."</td><td>".$ArrayIncidente[$cont][2]."</td><td>".$ArrayIncidente[$cont][3]."</td><td>".$ArrayIncidente[$cont][4]."</td><td>".$ArrayIncidente[$cont][5]."</td>
                    <td>".$ArrayIncidente[$cont][6]."</td><td>".$ArrayIncidente[$cont][7]."</td><td>".$ArrayIncidente[$cont][8]."</td></tr>";
              }
              $x=$x."</table></center>";
              echo $x;
include ("Includes/footer.php");
?>
