<?
    class CtrViajes{
	
		var $objViaje;
		var $recordSet;
		
		var $idRuta="";
		var $TipVehiculo="";
		var $IdVehiculo="";
		var $Fecha = "";
		var $Hora = "";
		
		 function CtrViajes($objViaje){
         $this->objViaje=$objViaje;
        }
		
		function guardar(){
			$idRuta=$this->objViaje->getidRuta();
			$TipVehiculo=$this->objViaje->getTipVehiculo();
			$IdVehiculo=$this->objViaje->getIdVehiculo();
			$Fecha=$this->objViaje->getFecha();
			$Hora=$this->objViaje->getHora();
			
			//Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');
			
			//Hacemos la consulta para verificar que no hala un registro con la misma identificación
			/*$consulta= "select * from tblviaje where Id_VEHI='".$idVehiculo."'";
			$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
			$numRegistros = mysql_num_rows($recordSet);
			
			
			//Si la consulta devuelve al menos un registro significa que ya hay un vehiculo con la misma identificacion
			//Retornamos 1: esto significa que la inserción no se podrá ejecutar
			if ($numRegistros>=1)
			{
				return 1;
			}*/
			$consulta= 
			"insert into tblviaje
			(
				Id_RUT_VIAJ,
				Id_VEH_VIAJ,
				Fecha_VIAJ,
				Hora_VIAJ
			)
			values 
			(
				'".$idRuta."','".$IdVehiculo."','".$Fecha."','".$Hora."'
			)";
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
		
		function listarRuta(){
			
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tblruta";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);
		  $matRuta[0][0]= $numRegistros;
		  $i=0;

              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $matRuta[$i][0]=  $registro['Id_RUT'];
			  $matRuta[$i][1]=  $registro['Descripcion_RUT'];
			  
               }

              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);
			
              return $matRuta;
        }
		
		function listarVehiculo(){
		$TipVehiculo=$this->objViaje->getTipVehiculo();

        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select Id_VEHI, Descripcion_VEH from  tblvehiculo where Id_TIP_VEH='".$TipVehiculo."'";
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

		  $matVehiculo[0][0]= $numRegistros;
		  $i=0;

              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $matVehiculo[$i][0]=  $registro['Id_VEHI'];
			  $matVehiculo[$i][1]=  $registro['Descripcion_VEH'];
               }

              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);
			
              return $matVehiculo;
        }
		
		function Listar(){

        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="	SELECT
						r.Descripcion_RUT,
						tv.Descripcion,
						ve.Descripcion_VEH,
						v.Fecha_VIAJ,
						v.Hora_VIAJ
					FROM 
						tblviaje v,
						tblruta r,
						tblvehiculo ve,
						tbltip_veh tv			
					where 
						v.Id_VEH_VIAJ=ve.Id_VEHI
						AND v.Id_RUT_VIAJ=r.Id_RUT
						AND tv.Id_TIP_VEH= ve.Id_TIP_VEH
				";
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
              $mat[$i][0]=  $registro['Descripcion_RUT'];
              $mat[$i][1]=  $registro['Descripcion'];
			  $mat[$i][2]=  $registro['Descripcion_VEH'];
			  $mat[$i][3]=  $registro['Fecha_VIAJ'];
			  $mat[$i][4]=  $registro['Hora_VIAJ'];
              }

        //SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCIÓN  mysql_free_result
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

        //RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VCliente.php)
              return $mat;
        }
		
		function modificar(){

        $identificacion=$this->objCliente->getIdentificacion();
    	$nombre=$this->objCliente->getNombre();
		$telefono=$this->objCliente->getTelefono();

		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

		
		//--------------Se ejecuta Comando SQL-------------------------
        $consulta=
			"update tblcliente set Nombre_CLI='".$nombre."', 
			Telefono_CLI='".$telefono."'  
			where Id_CLI ='".$identificacion."'";
		
        echo "<script>alert(\"El resultado de del comando SQL es:". $consulta."\"); </script>";//
		// echo " Comando SQL : ". $consulta;
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
		
		/*SELECT
r.Descripcion_RUT,
tv.Descripcion,
ve.Descripcion_VEH,
v.Fecha_VIAJ,
v.Hora_VIAJ
from 
tblviaje  v,
tblruta r,
tblvehiculo ve,
tbltip_veh tv
			
where 
v.Id_VEH_VIAJ=ve.Id_VEHI
AND v.Id_RUT_VIAJ=r.Id_RUT
and tv.Id_TIP_VEH= ve.Id_TIP_VEH */
	
	}
?>