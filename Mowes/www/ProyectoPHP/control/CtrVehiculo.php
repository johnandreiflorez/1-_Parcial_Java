<?
    class CtrVehiculo{
	
		var $objVehiculo;
		var $recordSet;
		
		var $idVehiculo="";
		var $Descripcion="";
		var $idTipVehiculo="";
		
		 function CtrVehiculo($objVehiculo){
         $this->objVehiculo=$objVehiculo;
        }
		
		function guardar(){
			$idVehiculo=$this->objVehiculo->getidVehiculo();
			$Descripcion=$this->objVehiculo->getDescripcion();
			$idTipVehiculo=$this->objVehiculo->getidTipVehiculo();
			
			echo $idVehiculo, $Descripcion, $idTipVehiculo;
			//Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');
			
			//Hacemos la consulta para verificar que no hala un registro con la misma identificación
			$consulta= "select * from tblvehiculo where Id_VEHI='".$idVehiculo."'";
			$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
			$numRegistros = mysql_num_rows($recordSet);
			
			
			//Si la consulta devuelve al menos un registro significa que ya hay un vehiculo con la misma identificacion
			//Retornamos 1: esto significa que la inserción no se podrá ejecutar
			if ($numRegistros>=1)
			{
				return 1;
			}
			$consulta= "insert into tblvehiculo values ('".$idVehiculo."','".$Descripcion."','".$idTipVehiculo."')";
			$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
			 $ObjConexion->cerrar($enlace);
			 
			//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
				if (!$recordSet)
				{
					die(" ERROR CON EL COMANDO SQL: ".mysql_error());
				}
				else
				{
					//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
					$this->recordSet=$recordSet;
				}
			return 0;
		}
		
		function listarTipoVehi(){
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tbltip_veh";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

		  $matTipVehi[0][0]= $numRegistros;
		  $i=0;

              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $matTipVehi[$i][0]=  $registro['Id_TIP_VEH'];
			  $matTipVehi[$i][1]=  $registro['Descripcion'];
               }

              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);
			
              return $matTipVehi;
        }
		
		function Listar(){

        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tblcliente";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_num_rows DEVUELVE EL NÚMERO DE REGISTROS DEL RECORDSET
         $numRegistros = mysql_num_rows($recordSet);

        //SE ASIGNA EN UNA POSICIÓN DESOCUPADA (EN ESTE CASO LA $mat[0][0], EL VALOR CON EL NÚMERO DE REGISTROS
              $mat[0][0]= $numRegistros;
              $i=0;

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA Cliente)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
        //  $registro
        //CON EL CICLO MIENTRAS SE ASIGNA CADA REGISTRO DEL RECORDSET A CADA FILA DE LA MATRIZ
              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $mat[$i][0]=  $registro['Id_CLI'];
              $mat[$i][1]=  $registro['Nombre_CLI'];
			  $mat[$i][2]=  $registro['Telefono_CLI'];
               }

        //SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCIÓN  mysql_free_result
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

        //RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VCliente.php)
              return $mat;
        }
		
		function Modificar(){
       		$idVehiculo=$this->objVehiculo->getidVehiculo();
			$Descripcion=$this->objVehiculo->getDescripcion();
			$idTipVehiculo=$this->objVehiculo->getidTipVehiculo();
		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

		
		//--------------Se ejecuta Comando SQL-------------------------
        $consulta=
			"update tblvehiculo set Descripcion_VEH='".$Descripcion."', 
			Id_TIP_VEH='".$idTipVehiculo."'  
			 where Id_VEHI ='".$idVehiculo."'";
		
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
         $ObjConexion->cerrar($enlace);

		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
			if (!$recordSet)
			{
				die("ERROR CON EL COMANDO SQL: ".mysql_error());
			}
			else
			{
				//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
				$this->recordSet=$recordSet;
			}
        }
		
		function Eliminar(){
       		$idVehiculo=$this->objVehiculo->getidVehiculo();
			$Descripcion=$this->objVehiculo->getDescripcion();
			$idTipVehiculo=$this->objVehiculo->getidTipVehiculo();
		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

		
		//--------------Se ejecuta Comando SQL-------------------------
        $consulta=
			"delete from tblvehiculo where Id_VEHI ='".$idVehiculo."'";
		
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
         $ObjConexion->cerrar($enlace);

		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
			if (!$recordSet)
			{
				die("ERROR CON EL COMANDO SQL: ".mysql_error());
			}
			else
			{
				//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
				$this->recordSet=$recordSet;
			}
        }
		
		function consultar(){
        $idVehiculo=$this->objVehiculo->getidVehiculo();
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tblvehiculo where 	Id_VEHI ='".$idVehiculo."'";
        //echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:

        $registro = mysql_fetch_array($recordSet);

        //SE ASIGNA EL VALOR DEL CAMPO 'nombre' DEL REGISTRO, AL ATRIBUTO nombre
        //DEL OBJETO objCliente MEDIANTE EL MÉTODO setNombre
        $this->objVehiculo->setDescripcion($registro['Descripcion_VEH']);
		$this->objVehiculo->setidTipVehiculo($registro['Id_TIP_VEH']);
		
        $ObjConexion->cerrar($enlace);
		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";//<br> es un salto de línea
		}
		else
		{
			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
	    return $this->objVehiculo;

		}

        }
	
	}
?>