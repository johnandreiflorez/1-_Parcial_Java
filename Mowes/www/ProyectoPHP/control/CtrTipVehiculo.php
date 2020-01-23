<?
    class CtrTipVehiculo{
	
		var $objTipVehiculo;
		var $recordSet;
		
		 function CtrTipVehiculo($objTipVehiculo){
         $this->objTipVehiculo=$objTipVehiculo;
        }
		
		function guardar(){
			$idTipVehiculo=$this->objTipVehiculo->getidTipVehiculo();
			$Descripcion=$this->objTipVehiculo->getDescripcion();
			
			
			//Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');
			
			//Ejecutamos el comando SQL para guardar
			$consulta= "insert into tbltip_veh values ('".$idTipVehiculo."','".$Descripcion."')";
			
			//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
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
		}
		
		function Listar(){

        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tbltip_veh";
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
              $mat[$i][0]=  $registro['Id_TIP_VEH'];
              $mat[$i][1]=  $registro['Descripcion'];
			  
               }

        //SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCIÓN  mysql_free_result
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

        //RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VCliente.php)
              return $mat;
        }
		
		function modificar(){

        $idTipVehiculo=$this->objTipVehiculo->getidTipVehiculo();
		$Descripcion=$this->objTipVehiculo->getDescripcion();

		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

		
		//--------------Se ejecuta Comando SQL-------------------------
        $consulta="update tbltip_veh set Descripcion='".$Descripcion."'  where Id_TIP_VEH ='".$idTipVehiculo."'";
        echo "<script>alert(\"El resultado de del comando SQL es:". $consulta."\"); </script>";//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
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
        $idTipVehiculo=$this->objTipVehiculo->getidTipVehiculo();
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from tbltip_veh where 	Id_TIP_VEH ='".$idTipVehiculo."'";
        //echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:

        $registro = mysql_fetch_array($recordSet);

        //SE ASIGNA EL VALOR DEL CAMPO 'nombre' DEL REGISTRO, AL ATRIBUTO nombre
        //DEL OBJETO objCliente MEDIANTE EL MÉTODO setNombre
        $this->objTipVehiculo->setDescripcion($registro['Descripcion']);
		
		
        $ObjConexion->cerrar($enlace);
		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";//<br> es un salto de línea
		}
		else
		{
			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
	    return $this->objTipVehiculo;

		}

        }
	
	}
?>