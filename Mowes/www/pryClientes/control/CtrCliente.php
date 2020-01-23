<?
    class CtrCliente{
	var $objCliente;
	var $recordSet;
        function CtrCliente($objCliente){
         $this->objCliente=$objCliente;

        }


        function consultar(){
        $idCliente=$this->objCliente->getIdCliente();
        $bd="BDpryClientes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from Cliente where id =".$idCliente;
         echo $consulta;
		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);

        $this->objCliente->setNomCliente($registro['nombre']);
        $this->objCliente->setFotoCliente($registro['foto']);

        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{

	    return $this->objCliente;

		}

        }
    function listarTelefonos(){
        $idCliente=$this->objCliente->getIdCliente();
        $bd="BDpryClientes";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');
        $consulta="select * from telefono where fkcliente=".$idCliente;
        $recordSet=$ObjConexion->ejecutarSql($bd,$consulta);

        $numRegistros = mysql_num_rows($recordSet);

        $vec[0]= $numRegistros;
        $i=0;

              while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $vec[$i]=  $registro['numero'];
              echo  "teléfono=".$vec[$i]."<br>";
               }

              mysql_free_result($recordSet);
              $ObjConexion->cerrar($enlace);

              return $vec;
        }
 }


?>