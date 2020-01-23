<?
    class CtrUsuario{
	var $objUsuario;
	var $recordSet;
        function CtrUsuario($objUsuario){
         $this->objUsuario=$objUsuario;

        }
       /*
        function CtrUsuario() {
        $nombre="CtrUsuario".func_num_args();
        $this->$nombre();
        }
        */

        function guardar(){

        $nomUsuario=$this->objUsuario->getNomUsuario();
    	$contrasena=$this->objUsuario->getContrasena();



		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');


		//--------------Se ejecuta Comando SQL-------------------------


        $consulta="insert into tblusuarios values('".$nomUsuario."','".$contrasena."')";
         echo " Comando SQL : ". $consulta;
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
		
        function modificar(){

        $nomUsuario=$this->objUsuario->getNomUsuario();
    	$contrasena=$this->objUsuario->getContrasena();



		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');


		//--------------Se ejecuta Comando SQL-------------------------


        $consulta="update tblUsuarios set strContrasena='".$contrasena."' where strUsuario ='".$nomUsuario."'";
         echo " Comando SQL : ". $consulta;
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
            
		function borrar(){
        $nomUsuario=$this->objUsuario->getNomUsuario();
    	$contrasena=$this->objUsuario->getContrasena();



		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');


		//--------------Se ejecuta Comando SQL-------------------------


        $consulta="delete from tblusuarios where strUsuario ='".$nomUsuario."'";
         echo " Comando SQL : ". $consulta;
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
		
        function consultar(){
        $nomUsuario=$this->objUsuario->getNomUsuario();
        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from tblusuarios where strUsuario ='".$nomUsuario."'";
        //echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:

        $registro = mysql_fetch_array($recordSet);

        //SE ASIGNA EL VALOR DEL CAMPO 'contrasena' DEL REGISTRO, AL ATRIBUTO contrasena
        //DEL OBJETO objUsuario MEDIANTE EL MÉTODO setContrasena
        $this->objUsuario->setContrasena($registro['contrasena']);
        $ObjConexion->cerrar($enlace);
		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{
			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
	    return $this->objUsuario;

		}

        }

        function listar(){

        $bd="viajes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from tblusuarios";
              $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_num_rows DEVUELVE EL NÚMERO DE REGISTROS DEL RECORDSET
              $numRegistros = mysql_num_rows($recordSet);

        //SE ASIGNA EN UNA POSICIÓN DESOCUPADA (EN ESTE CASO LA $mat[0][0], EL VALOR CON EL NÚMERO DE REGISTROS
              $mat[0][0]= $numRegistros;
              $i=0;

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA Usuario)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
        //  $registro
        //CON EL CICLO MIENTRAS SE ASIGNA CADA REGISTRO DEL RECORDSET A CADA FILA DE LA MATRIZ
              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $mat[$i][0]=  $registro['strUsuario'];
              $mat[$i][1]=  $registro['strContrasena'];

               }

        //SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCIÓN  mysql_free_result
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

        //RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VistaUsuario.php)
              return $mat;
        }

       function  validarIngreso(){
            $esValido=false;
            $objUsuario1 = new Usuario('','');
	        $ObjConexion=new CtrConexion();
            $bd="viajes";
            $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

            $consulta= "select * from tblUsuarios where tblUsuarios.strUsuario='" . $this->objUsuario->getNomUsuario().
             "' and tblUsuarios.strContrasena= '" . $this->objUsuario->getContrasena(). "'";

             try{
                 $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
                 $registro = mysql_fetch_array($recordSet);
                 $objUsuario1->setNomUsuario($registro['strUsuario']);
                 $objUsuario1->setContrasena($registro['strContrasena']);
;
                }
         	catch (Exception $e)
            	{
            	echo "ERROR SELECCIONANDO EN LA BASE DE DATOS".$e->getMessage()."\n";
                }
                 $ObjConexion->cerrar($enlace);

            if ($this->objUsuario->getNomUsuario()==$objUsuario1->getNomUsuario() &&
               $this->objUsuario->getContrasena()==$objUsuario1->getContrasena()  &&
               $this->objUsuario->getNomUsuario() != "" &&
               $this->objUsuario->getContrasena() != ""){
                 $esValido = true;
            }
            else
                {
                $esValido = false;
                }
             return $esValido;

      }
 }


?>