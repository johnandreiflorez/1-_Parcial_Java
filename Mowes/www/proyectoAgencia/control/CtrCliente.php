<?php
    class CtrCliente{
	var $objCliente;
    var $recordSet;

    function CtrCliente($objCliente){
         $this->objCliente=$objCliente;
    }

    function guardar(){

    }
    function listarComboFkCliente(){

        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','Agencia','root','');

        $comandoSql="Select * from Cliente";
         echo " Comando SQL : ". $comandoSql;

		$recordSet=$ObjConexion->ejecutarSql('Agencia',$comandoSql);


		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{
		    $numRegistros = mysql_num_rows($recordSet);
             $vector[0]= $numRegistros;
             $i=0;

            while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $vector[$i]=  $registro['IDCLIENTE'];
            }
              mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);
        }
        return  $vector;
    }

    function consultar(){

    $idCliente=$this->objCliente->getIdCliente();
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','Agencia','root','');

        $comandoSql="Select * from Cliente where idcliente=".$idCliente;
         echo " Comando SQL : ". $comandoSql;

		$recordSet=$ObjConexion->ejecutarSql('Agencia',$comandoSql);


		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error());
		}
		else
		{

            if ($registro = mysql_fetch_array($recordSet)){
              $this->objCliente->setNombre($registro['NOMBRE']);
              $this->objCliente->setCelular($registro['CELULAR']);
            }
              mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);
        }
        return  $this->objCliente;
    }

 }


?>