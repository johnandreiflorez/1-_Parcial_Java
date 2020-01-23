<?
    class CtrReserva{
	
		var $objReserva;
		var $recordSet;
		
		var $Id_Viaje ;
		var	$Id_Cliente ;
		var	$Cantidad ;
		var	$Id_Estado ;
		var $Id_RUT_VIAJ;
		var $Fecha_VIAJ;
		var $Id_VEH_VIAJ;
				
		 function CtrReserva($objReserva){
         $this->objReserva=$objReserva;
        }
		
		function guardar(){
		
				  $Id_Viaje=$this->objReserva->getId_Viaje();
				  $Id_Cliente=$this->objReserva->getId_Cliente();
				  $Cantidad=$this->objReserva->getCantidad();
				  $Id_Estado=$this->objReserva->getId_Estado();
		
			//Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');
			
			$consulta= 
			"insert into tblreserva
			(
				Id_VIAje_RES ,
				Id_CLIente_RES ,
				Cantidad_RES ,
				Id_ESTado_RES 
			)
			values 
			(
				'".$Id_Viaje."','".$Id_Cliente."','".$Cantidad."','".$Id_Estado."'
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
		
		function ListarViajesRes(){
		$Id_RUT_VIAJ=$this->objReserva->getId_RUT_VIAJ();
		$Fecha_VIAJ =$this->objReserva->getFecha_VIAJ();;
	    $Id_VEH_VIAJ =$this->objReserva->getId_VEH_VIAJ();;
		
		echo $Id_RUT_VIAJ, $Fecha_VIAJ ,  $Id_VEH_VIAJ ;
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="	
		
		SELECT 
			Id_VIAJ AS Codigo_Viaje, 
			Descripcion_RUT AS Ruta, 
			Descripcion_VEH AS PlacaCarro, 
			Fecha_VIAJ AS Fecha, 
			Hora_VIAJ AS Hora
		FROM 
			tblVIAJe
		INNER JOIN tblRUTa ON Id_RUT_VIAJ = Id_RUT
		INNER JOIN tblVEHiculo ON Id_VEHI = Id_VEH_VIAJ
		WHERE Id_RUT_VIAJ =  '".$Id_RUT_VIAJ."'
		AND Fecha_VIAJ =  '".$Fecha_VIAJ."'
		AND Id_TIP_VEH =  '".$Id_VEH_VIAJ."'
		ORDER BY Hora_VIAJ
					   
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
              $mat[$i][0]=  $registro['Codigo_Viaje'];
              $mat[$i][1]=  $registro['Ruta'];
			  $mat[$i][2]=  $registro['PlacaCarro'];
			  $mat[$i][3]=  $registro['Fecha'];
			  $mat[$i][4]=  $registro['Hora'];
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
		
	
	}
?>