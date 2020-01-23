<?php
   class CtrVivienda{
	var $objVivienda;
    var $recordSet;

    function CtrVivienda($objVivienda){
         $this->objVivienda=$objVivienda;
    }

    function guardar(){

        $idVivienda=$this->objVivienda->getIdVivienda();
    	$direcion=$this->objVivienda->getDirecion();
        $telefono=$this->objVivienda->getTelefono();
    	$tipo=$this->objVivienda->getTipo();
        $fkCliente=$this->objVivienda->getFkCliente();

        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','Agencia','root','');

$comandoSql="insert into vivienda values(".$idVivienda.",'".$direcion."','".$telefono."','".$tipo."',".$fkCliente.")";
         echo " Comando SQL : ". $comandoSql;

		$recordSet=$ObjConexion->ejecutarSql('Agencia',$comandoSql);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{
       	$this->recordSet=$recordSet;
        }
      }

    function consultar(){

    $idVivienda=$this->objVivienda->getIdVivienda();
    echo " idVivienda : ". $idVivienda;
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','Agencia','root','');

        $comandoSql="Select * from Vivienda where idVivienda=".$idVivienda;
         echo " Comando SQL : ". $comandoSql;

		$recordSet=$ObjConexion->ejecutarSql('Agencia',$comandoSql);


		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{

            if ($registro = mysql_fetch_array($recordSet)){
              $this->objVivienda->setDirecion($registro['DIRECCION']);
              $this->objVivienda->setTelefono($registro['TELEFONO']);
              $this->objVivienda->setTipo($registro['TIPO']);
              $this->objVivienda->setFkCliente($registro['FKCLIENTE']);
            }
              mysql_free_result($recordSet);
                $ObjConexion->cerrar($enlace);
        }
        return  $this->objVivienda;
    }

 }
?>