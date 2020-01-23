<?
    class CtrArea{
	var $objArea;
	var $recordSet;
        function CtrArea($objArea){

        $this-> objArea=$objArea;
        }
       /*
        function CtrArea() {
        $nombre="CtrArea".func_num_args();
        $this->$nombre();
        }
        */

        function guardar(){

        $idarea=$this->objArea->getIdarea();
    	$nombre=$this->objArea->getNombre();
        $fkemple=$this->objArea->getFkemple();


		//---------NOS CONECTAMOS A LA BASE DE DATOS-----------------------------------------------------------
        $bd="help";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');


		//--------------Se ejecuta Comando SQL-------------------------
	  // $consulta="call pa_insertararea($idarea,$nombre,$fkemple)";

        $consulta="insert into area values(".$idarea.",'".$nombre."',".$fkemple.")";
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

        $idarea=$this->objArea->getIdarea();
        $bd="help";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from area where idArea =".$idarea;
        //echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        // LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA AREA)
        // AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
        //  $registro
        $registro = mysql_fetch_array($recordSet);

        //SE ASIGNA EL VALOR DEL CAMPO 'nombre' DEL REGISTRO, AL ATRIBUTO nombre
        //DEL OBJETO objArea MEDIANTE EL MÉTODO setNombre
        $this->objArea->setNombre($registro['nombre']);


        //SE ASIGNA EL VALOR DEL CAMPO 'fkEmple' DEL REGISTRO, AL ATRIBUTO fkEmple
        //DEL OBJETO objArea MEDIANTE EL MÉTODO setFkEmple
        $this->objArea->setFkEmple($registro['fkEmple']);

        $ObjConexion->cerrar($enlace);
		//--------------VERIFICAMOS SI SE REALIZO LA CONSULTA--------------------------------------------------
		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{
			//----------AL RESULTADO QUE SE VA A RETORNAR = RESULTADO DE LA CONSULTA---------------
	    return $this->objArea;

		}

        }



        function listarAreas(){

        $bd="help";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from area";
              $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

// LA FUNCIÓN  mysql_num_rows DEVUELVE EL NÚMERO DE REGISTROS DEL RECORDSET
              $numRegistros = mysql_num_rows($recordSet);

//SE ASIGNA EN UNA POSICIÓN DESOCUPADA (EN ESTE CASO LA $mat[1][4], EL VALOR CON EL NÚMERO DE REGISTROS
              $mat[1][4]= $numRegistros;
              $i=1;

// LA FUNCIÓN  mysql_fetch_array   PERMITE RECORRER EL RECORDSET (CURSOR A LA TABLA AREA)
// AQUÍ SE ASIGNA EL CONTENIDO DEL PRIMER REGISTRO DEL RECORDSET A UNA VARIABLE IDENTIFICADA COMO:
//  $registro
//CON EL CICLO MIENTRAS SE ASIGNA CADA REGISTRO DEL RECORDSET A CADA FILA DE LA MATRIZ
              while ($registro = mysql_fetch_array($recordSet)){

              $mat[$i][1]=  $registro['idArea'];
              $mat[$i][2]=  $registro['nombre'];
              $mat[$i][3]=  $registro['fkEmple'];
              $i=$i+1;
               }

//SE LIBERA MEMORIA DEL CURSOR ($recordSet) CON LA FUNCIÓN  mysql_free_result
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

//RETORNA LA MATRIZ CON LOS REGISTROS, PARA SER RECORRIDA EN LA VISTA (VistaArea.php)
              return $mat;
        }


    }


?>