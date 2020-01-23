<?
session_start();
      class CtrResponsable{
	    var $objResponsable;
	    var $recordSet;
        function CtrResponsable($objResponsable){
         $this->objResponsable=$objResponsable;

        }



        function guardar(){

        $ID_RESP=$this->objResponsable->GetID_RESP();
        $NOMB_RESP=$this->objResponsable->GetNOMB_RESP();
        $APELL_RESP=$this->objResponsable->GetAPELL_RESP();
        $EMAIL_RESP=$this->objResponsable->GetEMAIL_RESP();
        $TEL_RESP=$this->objResponsable->GetTEL_RESP();
        $CEL_RESP=$this->objResponsable-> GetCEL_RESP();
        $CARGO_RESP=$this->objResponsable->GetCARGO_RESP();
        $COUNTUSER_RESP=$this->objResponsable->GetCOUNTUSER_RESP();
        $PASSWORD_RESP=$this->objResponsable-> GetPASSWORD_RESP();
        $FOTO_RESP=$this->objResponsable-> GetFOTO_RESP();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $guardar="INSERT INTO responsable VALUES ('".$ID_RESP."','".$NOMB_RESP."','".$APELL_RESP."','".$EMAIL_RESP."','".$TEL_RESP."',
        '".$CEL_RESP."','".$CARGO_RESP."','".$COUNTUSER_RESP."','".$PASSWORD_RESP."','".$FOTO_RESP."')";

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

        $ID_RESP=$this->objResponsable->GetID_RESP();
        $NOMB_RESP=$this->objResponsable->GetNOMB_RESP();
        $APELL_RESP=$this->objResponsable->GetAPELL_RESP();
        $EMAIL_RESP=$this->objResponsable->GetEMAIL_RESP();
        $TEL_RESP=$this->objResponsable->GetTEL_RESP();
        $CEL_RESP=$this->objResponsable-> GetCEL_RESP();
        $CARGO_RESP=$this->objResponsable->GetCARGO_RESP();
        $COUNTUSER_RESP=$this->objResponsable->GetCOUNTUSER_RESP();
        $PASSWORD_RESP=$this->objResponsable-> GetPASSWORD_RESP();
        $FOTO_RESP=$this->objResponsable-> GetFOTO_RESP();

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $modificar="UPDATE responsable SET ID_RESP='".$ID_RESP."',NOMB_RESP='".$NOMB_RESP."', APELL_RESP='".$APELL_RESP."', EMAIL_RESP='".$EMAIL_RESP."',
        TEL_RESP='".$TEL_RESP."', CEL_RESP='".$CEL_RESP."', CARGO_RESP='".$CARGO_RESP."', COUNTUSER_RESP='".$COUNTUSER_RESP."',
        PASSWORD_RESP='".$PASSWORD_RESP."', FOTO_RESP='".$FOTO_RESP."'
        WHERE ID_RESP ='".$ID_RESP."'";

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
        $ID_RESP=$this->objResponsable->GetID_RESP();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from responsable where ID_RESP =".$ID_RESP;

		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);

        $this->objResponsable->setNOMB_RESP($registro['NOMB_RESP']);
        $this->objResponsable->setAPELL_RESP($registro['APELL_RESP']);
        $this->objResponsable->setEMAIL_RESP($registro['EMAIL_RESP']);
        $this->objResponsable->setTEL_RESP($registro['TEL_RESP']);
        $this->objResponsable->setCEL_RESP($registro['CEL_RESP']);
        $this->objResponsable->setCARGO_RESP($registro['CARGO_RESP']);
        $this->objResponsable->setCOUNTUSER_RESP($registro['COUNTUSER_RESP']);
        $this->objResponsable->setPASSWORD_RESP($registro['PASSWORD_RESP']);
        $this->objResponsable->setFOTO_RESP($registro['FOTO_RESP']);


        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objResponsable;

		}
        }

        function eliminar(){
        $ID_RESP=$this->objResponsable->GetID_RESP();
        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $eliminar="DELETE FROM responsable WHERE ID_RESP =".$ID_RESP;

        echo $eliminar;
		$recordSet=$ObjConexion->ejecutarSql($bd,$eliminar);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objResponsable;

		}
        }


        function  validarIngreso(){
            $esValido=false;
            $objResponsable1 = new Responsable('','','','','','','','','','');
	        $ObjConexion=new CtrConexion();
            $bd="softech";
            $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

            $consulta= "select * from responsable where responsable.COUNTUSER_RESP='" . $this->objResponsable->getCOUNTUSER_RESP().
             "' and responsable.PASSWORD_RESP= '" . $this->objResponsable->getPASSWORD_RESP(). "'";

             try{
                 $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
                 $registro = mysql_fetch_array($recordSet);
                 $objResponsable1->setCOUNTUSER_RESP($registro['COUNTUSER_RESP']);
                 $objResponsable1->setPASSWORD_RESP($registro['PASSWORD_RESP']);
;
                }
         	catch (Exception $e)
            	{
            	echo "ERROR SELECCIONANDO EN LA BASE DE DATOS".$e->getMessage()."\n";
                }
                 $ObjConexion->cerrar($enlace);

            if ($this->objResponsable->getCOUNTUSER_RESP()==$objResponsable1->getCOUNTUSER_RESP() &&
               $this->objResponsable->getPASSWORD_RESP()==$objResponsable1->getPASSWORD_RESP()  &&

              $this->objResponsable->getCOUNTUSER_RESP() != "" &&
               $this->objResponsable->getPASSWORD_RESP() != ""){
                 $esValido = true;
                  $_SESSION["COUNTUSER_RESP"] = $registro["COUNTUSER_RESP"];
	            $_SESSION["PASSWORD_RESP"] = $registro["PASSWORD_RESP"];
            }
            else
                {
                $esValido = false;
                }
             return $esValido;

      }


      function listar(){

        $bd="softech";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="SELECT * FROM responsable";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

        $mat[0][0]= $numRegistros;
        $i=0;

        while ($registro = mysql_fetch_array($recordSet))
        {
	    $i=$i+1;
        $mat[$i][0]=  $registro['ID_RESP'];
        $mat[$i][1]=  $registro['NOMB_RESP'];
        $mat[$i][2]=  $registro['APELL_RESP'];
        $mat[$i][3]=  $registro['EMAIL_RESP'];
        $mat[$i][4]=  $registro['TEL_RESP'];
        $mat[$i][5]=  $registro['CEL_RESP'];
        $mat[$i][6]=  $registro['CARGO_RESP'];
        $mat[$i][7]=  $registro['COUNTUSER_RESP'];
        $mat[$i][8]=  $registro['PASSWORD_RESP'];
        $mat[$i][10]= $registro['FOTO_RESP'];
        }

        mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);

        return $mat;
        }


        }
?>

