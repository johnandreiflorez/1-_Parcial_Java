<?
class CtrRuta
{
		var $objRuta;
		var $recordSet;

		function CtrRuta($objRuta)
		{
            $this->objRuta=$objRuta;
        }


		function guardar()//este m�todo es para insertar
		{
			$id_ruta=$this->objRuta->getId_Ruta();
			$descripcion=$this->objRuta->getDescripcion();

            //Nos conectamos a la base de datos
			$bd="viajes";
			$ObjConexion=new CtrConexion();
			$enlace=$ObjConexion->conectar('localhost',$bd,'root','');

			//Ejecutamos el comando SQL para guardar
			$consulta= "insert into tblruta values ('".$id_ruta."','".$descripcion."')";
			echo "<script>alert(\"El resultado del comando SQL es:". $consulta."\"); </script>";//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
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


        function Listar()
        {
          $bd="viajes";
          $ObjConexion=new CtrConexion();
          $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
          $consulta="select * from tblruta";
          $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

          // LA FUNCI�N  mysql_num_rows DEVUELVE EL N�MERO DE REGISTROS DEL RECORDSET
          $numRegistros = mysql_num_rows($recordSet);
         //SE ASIGNA EN UNA POSICI�N DESOCUPADA (EN ESTE CASO LA $mat[0][0], EL VALOR CON EL N�MERO DE REGISTROS
          $mat[0][0]= $numRegistros;
          $i=0;
        // LA FUNCI�N  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA Ruta)
        // AQU� SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
        //  $registro
        //CON EL CICLO MIENTRAS SE ASIGNA CADA REGISTRO DEL RECORDSET A CADA FILA DE LA MATRIZ
           while ($registro = mysql_fetch_array($recordSet))
           {
	          $i=$i+1;
              $mat[$i][0]=  $registro['Id_RUT'];
              $mat[$i][1]=  $registro['Descripcion_RUT'];
           }
        //SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCI�N  mysql_free_result
           mysql_free_result($recordSet);
           $ObjConexion->cerrar($enlace);
        //RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VRuta.php)
              return $mat;
        }


        function modificar()
        {
            $id_ruta=$this->objRuta->getId_Ruta();
			$descripcion=$this->objRuta->getDescripcion();
    		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
            $bd="viajes";
            $ObjConexion=new CtrConexion();
            $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

    		//--------------Se ejecuta Comando SQL-------------------------
            $consulta="update tblruta set Descripcion_RUT='".$descripcion."' where Id_RUT ='".$id_ruta."'";
            echo "<script>alert(\"El resultado del comando SQL es:". $consulta."\"); </script>";//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
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

        function consultar()
        {
            $id_ruta=$this->objRuta->getId_Ruta();
            $bd="viajes";
            $ObjConexion=new CtrConexion();
            $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
            $consulta="select * from tblruta where 	Id_RUT ='".$id_ruta."'";
            echo "<script>alert(\"El resultado del comando SQL es:". $consulta."\"); </script>";//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
            //echo " Comando SQL : ". $consulta."<br>";
      		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

            // LA FUNCI�N  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA)
            // AQU� SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
            $registro = mysql_fetch_array($recordSet);

            //SE ASIGNA EL VALOR DEL CAMPO 'descripcion' DEL REGISTRO, AL ATRIBUTO descripcion
            //DEL OBJETO objRuta MEDIANTE EL M�TODO setDescripcion
            $this->objRuta->setDescripcion($registro['Descripcion_RUT']);
            $ObjConexion->cerrar($enlace);

            //--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
    		if (!$recordSet)
    		{
    			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";//<br> es un salto de l�nea
    		}
    		else
    		{
    			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
    	        return $this->objRuta;
    		}
        }


        function eliminar()
        {
            $id_ruta=$this->objRuta->getId_Ruta();
    		$descripcion=$this->objRuta->getDescripcion();
    		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
            $bd="viajes";
            $ObjConexion=new CtrConexion();
            $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

    		//--------------Se ejecuta Comando SQL-------------------------
            $consulta="delete from tblruta where Id_RUT  ='".$id_ruta."'";
            echo "<script>alert(\"El resultado del comando SQL es:". $consulta."\"); </script>";//este javascript me muestra un mensaje de la operacion realizada, en este caso de insertar
            //echo " Comando SQL : ". $consulta;
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
}
?>