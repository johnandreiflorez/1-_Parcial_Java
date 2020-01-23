<?
    class CtrCliente{
	
		var $objCliente;
		var $recordSet;
		
		 function CtrCliente($objCliente){
         $this->objCliente=$objCliente;
        }
		
		function guardar(){
			$identificacion=$this->objCliente->getIdentificacion();
			$nombre=$this->objCliente->getNombre();
			$telefono=$this->objCliente->getTelefono();
			
			
			//Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');
			
			//Hacemos la consulta para verificar que no hala un registro con la misma identificación
			$consulta= "select * from tblcliente where Id_CLI='".$identificacion."'";
			$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
			$numRegistros = mysql_num_rows($recordSet);
			
			//Si la consulta devuelve al menos un registro significa que ya la persona esta registrada
			//Retornamos 1: esto significa que la inserción no se podrá ejecutar
			if ($numRegistros>=1)
			{
				return 1;
			}
			$consulta= "insert into tblcliente values ('".$identificacion."','".$nombre."','".$telefono."')";
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
        $identificacion=$this->objCliente->getIdentificacion();
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from tblcliente where 	Id_CLI ='".$identificacion."'";
        //echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:

        $registro = mysql_fetch_array($recordSet);

        //SE ASIGNA EL VALOR DEL CAMPO 'nombre' DEL REGISTRO, AL ATRIBUTO nombre
        //DEL OBJETO objCliente MEDIANTE EL MÉTODO setNombre
        $this->objCliente->setNombre($registro['Nombre_CLI']);
		$this->objCliente->setTelefono($registro['Telefono_CLI']);
		
        $ObjConexion->cerrar($enlace);
		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";//<br> es un salto de línea
		}
		else
		{
			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
	    return $this->objCliente;

		}

        }
	
	}
?>