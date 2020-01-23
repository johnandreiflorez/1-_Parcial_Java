<?
      class CtrUsuario{
	    var $objUsuario;
	    var $recordSet;
        function CtrUsuario($objUsuario){
         $this->objUsuario=$objUsuario;

        }



        function guardar(){

        $ID_USER=$this->objUsuario->GetID_USER();
        $NOMB_USER=$this->objUsuario->GetNOMB_USER();
        $APELL_USER=$this->objUsuario->GetAPELL_USER();
        $EMAIL_USER=$this->objUsuario->GetEMAIL_USER();
        $TEL_USER=$this->objUsuario->GetTEL_USER();
        $CEL_USER=$this->objUsuario-> GetCEL_USER();
        $DIR_USER=$this->objUsuario->GetDIR_USER();
        $COUNTUSER_USER=$this->objUsuario->GetCOUNTUSER_USER();
        $PASSWORD_USER=$this->objUsuario-> GetPASSWORD_USER();
        $FKCIUDAD=$this->objUsuario-> GetFKCIUDAD();
        $FOTO_USER=$this->objUsuario-> GetFOTO_USER();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $guardar="INSERT INTO usuario VALUES ('".$ID_USER."','".$NOMB_USER."','".$APELL_USER."','".$EMAIL_USER."','".$TEL_USER."',
        '".$CEL_USER."','".$DIR_USER."','".$COUNTUSER_USER."','".$PASSWORD_USER."','".$FKCIUDAD."','".$FOTO_USER."')";

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

        $ID_USER=$this->objUsuario->GetID_USER();
        $NOMB_USER=$this->objUsuario->GetNOMB_USER();
        $APELL_USER=$this->objUsuario->GetAPELL_USER();
        $EMAIL_USER=$this->objUsuario->GetEMAIL_USER();
        $TEL_USER=$this->objUsuario->GetTEL_USER();
        $CEL_USER=$this->objUsuario-> GetCEL_USER();
        $DIR_USER=$this->objUsuario->GetDIR_USER();
        $COUNTUSER_USER=$this->objUsuario->GetCOUNTUSER_USER();
        $PASSWORD_USER=$this->objUsuario-> GetPASSWORD_USER();
        $FKCIUDAD=$this->objUsuario-> GetFKCIUDAD();
        $FOTO_USER=$this->objUsuario-> GetFOTO_USER();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $modificar="UPDATE usuario SET NOMB_USER='".$NOMB_USER."', APELL_USER='".$APELL_USER."', EMAIL_USER='".$EMAIL_USER."',
        TEL_USER='".$TEL_USER."', CEL_USER='".$CEL_USER."', DIR_USER='".$DIR_USER."', COUNTUSER_USER='".$COUNTUSER_USER."',
        PASSWORD_USER='".$PASSWORD_USER."', FKCIUDAD='".$FKCIUDAD."', FOTO_USER='".$FOTO_USER."'
        WHERE ID_USER ='".$ID_USER."'";

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
        $ID_USER=$this->objUsuario->GetID_USER();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="SELECT  ID_USER,NOMB_USER,APELL_USER,EMAIL_USER,TEL_USER,CEL_USER,DIR_USER,COUNTUSER_USER,PASSWORD_USER,
        NOMB_CIUDAD,FOTO_USER FROM ciudad INNER JOIN usuario ON ciudad.COD_CIUDAD = Usuario.FKCIUDAD where id_user =".$ID_USER;


		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);

        $this->objUsuario->setNOMB_USER($registro['NOMB_USER']);
        $this->objUsuario->setAPELL_USER($registro['APELL_USER']);
        $this->objUsuario->setEMAIL_USER($registro['EMAIL_USER']);
        $this->objUsuario->setTEL_USER($registro['TEL_USER']);
        $this->objUsuario->setCEL_USER($registro['CEL_USER']);
        $this->objUsuario->setDIR_USER($registro['DIR_USER']);
        $this->objUsuario->setCOUNTUSER_USER($registro['COUNTUSER_USER']);
        $this->objUsuario->setPASSWORD_USER($registro['PASSWORD_USER']);
        $this->objUsuario->SetFKCIUDAD($registro['NOMB_CIUDAD']);
        $this->objUsuario->setFOTO_USER($registro['FOTO_USER']);


        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objUsuario;

		}
        }

        function eliminar(){
        $ID_USER=$this->objUsuario->GetID_USER();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $eliminar="DELETE FROM usuario WHERE ID_USER =".$ID_USER;

        echo $eliminar;
		$recordSet=$ObjConexion->ejecutarSql($bd,$eliminar);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objUsuario;

		}
        }


             function listar(){

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="SELECT * FROM Usuario";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

        $mat[0][0]= $numRegistros;
        $i=0;

        while ($registro = mysql_fetch_array($recordSet))
        {
	    $i=$i+1;
        $mat[$i][0]=  $registro['ID_USER'];
        $mat[$i][1]=  $registro['NOMB_USER'];
        $mat[$i][2]=  $registro['APELL_USER'];
        $mat[$i][3]=  $registro['EMAIL_USER'];
        $mat[$i][4]=  $registro['TEL_USER'];
        $mat[$i][5]=  $registro['CEL_USER'];
        $mat[$i][6]=  $registro['DIR_USER'];
        $mat[$i][7]=  $registro['COUNTUSER_USER'];
        $mat[$i][8]=  $registro['PASSWORD_USER'];
        $mat[$i][9]=  $registro['FKCIUDAD'];
        $mat[$i][10]= $registro['FOTO_USER'];
        }

        mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);

        return $mat;
        }


        }
?>

