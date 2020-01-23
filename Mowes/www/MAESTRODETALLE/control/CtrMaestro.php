<?php
   class CtrMaestro{
	var $objMaestro;
    var $recordSet;

    function CtrMaestro($objMaestro){
         $this->objMaestro=$objMaestro;
    }

    function guardar(){

        $idMaestro=$this->objMaestro->getIdMaestro();
    	$nombre=$this->objMaestro->getNombre();
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','MAESTRODETALLE','root','');

$comandoSql="insert into Maestro values('".$idMaestro."','".$nombre."')";


		$recordSet=$ObjConexion->ejecutarSql('MAESTRODETALLE',$comandoSql);
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
        $idMaestro=$this->objMaestro->getIdMaestro();

        $bd="MAESTRODETALLE";
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost',$bd,'root','');

        $consulta="select * from maestro where idmaestro ='".$idMaestro."'";

		$recordSet=$ObjConexion->ejecutarSql($bd,$consulta);
        $registro = mysql_fetch_array($recordSet);
        $this->objMaestro->setNombre($registro['NOMBRE']);
        $ObjConexion->cerrar($enlace);

		if (!$recordSet)
		{
			die(" ERROR CON EL COMANDO SQL: ".mysql_error())."<br>";
		}
		else
		{
	    return $this->objMaestro;

		}

        }
 }
?>