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
         echo " Comando SQL : ". $consulta."<br>";
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);
        $this->objArea->setNombre($registro['nombre']);
        $this->objArea->setFkEmple($registro['fkEmple']);
        echo $registro['idArea']." ".$registro['nombre']." ".$registro['fkEmple']."\n\r"."<br>";
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
        		$vec[1]=1;
                $vec[2]=2;
                $vec[3]=3;
                $vec[4]=4;
                $vec[5]=5;

                $mat[1][1]=1;
                $mat[1][2]="hugo";
                $mat[1][3]=999;

                $mat[2][1]=1;
                $mat[2][2]="paco";
                $mat[2][3]=10;

                $mat[3][1]=1;
                $mat[3][2]="luis";
                $mat[3][3]=1;



        $bd="help";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from area";
              $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
              $numRegistros = mysql_num_rows($recordSet);
              echo " Comando SQL : ". $consulta."<br>";
              echo "  !!! ".$numRegistros." Registros encontrados."."<br>";
              while ($registro = mysql_fetch_array($recordSet)){
              echo $registro['idArea']." ".$registro['nombre']." ".$registro['fkEmple']."\n\r"."<br>";
               }
              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

              for($i=1;$i<=3;$i++){
              		echo $mat[$i][1]." ".$mat[$i][2]." ".$mat[$i][3]."<br>";

              }
              include("../modelo/guardarArea1.php");
              return $mat;
        }

    }


?>