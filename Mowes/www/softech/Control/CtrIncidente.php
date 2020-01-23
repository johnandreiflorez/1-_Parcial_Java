<?
      class CtrIncidente{
	    var $objIncidente;
	    var $recordSet;
        function CtrIncidente($objIncidente){
         $this->objIncidente=$objIncidente;

        }



        function guardar(){

        $COD_INCID=$this->objIncidente->GetCOD_INCID();
        $DESC_INCID=$this->objIncidente->GetDESC_INCID();
        $FECHAREGIS_INCID=$this->objIncidente->GetFECHAREGIS_INCID();
        $FECHASOLUC_INCID=$this->objIncidente->GetFECHASOLUC_INCID();
        $FKUSUARIO=$this->objIncidente->GetFKUSUARIO();
        $FKPRIORIDAD=$this->objIncidente-> GetFKPRIORIDAD();
        $FKESTADO=$this->objIncidente->GetFKESTADO();
        $FKCATEGORIA=$this->objIncidente->GetFKCATEGORIA();
        $FKRESPONSABLE=$this->objIncidente-> GetFKRESPONSABLE();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $guardar="INSERT INTO incidente VALUES ('".$COD_INCID."','".$DESC_INCID."','".$FECHAREGIS_INCID."','".$FECHASOLUC_INCID."','".$FKUSUARIO."',
        '".$FKPRIORIDAD."','".$FKESTADO."','".$FKCATEGORIA."','".$FKRESPONSABLE."')";

		$recordSet=$ObjConexion->ejecutarSql($bd,$guardar);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{
	        $this->recordSet=$recordSet;
		}

        }


        function modificar(){

        $COD_INCID=$this->objIncidente->GetCOD_INCID();
        $DESC_INCID=$this->objIncidente->GetDESC_INCID();
        $FECHAREGIS_INCID=$this->objIncidente->GetFECHAREGIS_INCID();
        $FECHASOLUC_INCID=$this->objIncidente->GetFECHASOLUC_INCID();
        $FKUSUARIO=$this->objIncidente->GetFKUSUARIO();
        $FKPRIORIDAD=$this->objIncidente-> GetFKPRIORIDAD();
        $FKESTADO=$this->objIncidente->GetFKESTADO();
        $FKCATEGORIA=$this->objIncidente->GetFKCATEGORIA();
        $FKRESPONSABLE=$this->objIncidente-> GetFKRESPONSABLE();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $modificar="UPDATE incidente SET DESC_INCID='".$DESC_INCID."', FECHAREGIS_INCID='".$FECHAREGIS_INCID."', FECHASOLUC_INCID='".$FECHASOLUC_INCID."',
        FKUSUARIO='".$FKUSUARIO."', FKPRIORIDAD='".$FKPRIORIDAD."', FKESTADO='".$FKESTADO."', FKCATEGORIA='".$FKCATEGORIA."',
        FKRESPONSABLE='".$FKRESPONSABLE."'
        WHERE COD_INCID ='".$COD_INCID."'";

        echo $modificar;

		$recordSet=$ObjConexion->ejecutarSql($bd,$modificar);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{
	        $this->recordSet=$recordSet;
		}

        }


        function consultar(){
        $COD_INCID=$this->objIncidente->GetCOD_INCID();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="SELECT  COD_INCID,DESC_INCID,FECHAREGIS_INCID,FECHASOLUC_INCID,FKUSUARIO,DESC_PRIORIDAD,NOMB_ESTADO,NOMB_CATEG,FKRESPONSABLE
        FROM incidente INNER JOIN categoria ON incidente.FKCATEGORIA = categoria.COD_CATEG INNER JOIN estado ON incidente.FKESTADO = estado.COD_ESTADO
        INNER JOIN prioridad ON incidente.FKPRIORIDAD = prioridad.COD_PRIORIDAD where COD_INCID =".$COD_INCID;

		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);

        $this->objIncidente->setDESC_INCID($registro['DESC_INCID']);
        $this->objIncidente->setFECHAREGIS_INCID($registro['FECHAREGIS_INCID']);
        $this->objIncidente->setFECHASOLUC_INCID($registro['FECHASOLUC_INCID']);
        $this->objIncidente->setFKUSUARIO($registro['FKUSUARIO']);
        $this->objIncidente->setFKPRIORIDAD($registro['DESC_PRIORIDAD']);
        $this->objIncidente->setFKESTADO($registro['NOMB_ESTADO']);
        $this->objIncidente->setFKCATEGORIA($registro['NOMB_CATEG']);
        $this->objIncidente->setFKRESPONSABLE($registro['FKRESPONSABLE']);

        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objIncidente;

		}
        }

        function eliminar(){
        $COD_INCID=$this->objIncidente->GetCOD_INCID();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $eliminar="DELETE FROM incidente WHERE COD_INCID =".$COD_INCID;

        echo $eliminar;
		$recordSet=$ObjConexion->ejecutarSql($bd,$eliminar);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objIncidente;

		}
        }


        function listar(){

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="SELECT * FROM incidente";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

        $mat[0][0]= $numRegistros;
        $i=0;

        while ($registro = mysql_fetch_array($recordSet))
        {
	    $i=$i+1;
        $mat[$i][0]=  $registro['COD_INCID'];
        $mat[$i][1]=  $registro['DESC_INCID'];
        $mat[$i][2]=  $registro['FECHAREGIS_INCID'];
        $mat[$i][3]=  $registro['FECHASOLUC_INCID'];
        $mat[$i][4]=  $registro['FKUSUARIO'];
        $mat[$i][5]=  $registro['FKPRIORIDAD'];
        $mat[$i][6]=  $registro['FKESTADO'];
        $mat[$i][7]=  $registro['FKCATEGORIA'];
        $mat[$i][8]=  $registro['FKRESPONSABLE'];
        }

        mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);

        return $mat;
        }


        }
?>

