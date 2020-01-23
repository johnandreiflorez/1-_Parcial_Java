<?php
   class CtrDetalle{
	var $objDetalle;
    var $recordSet;

    function CtrDetalle($objDetalle){
         $this->objDetalle=$objDetalle;
    }

    function guardar(){
        $dato=$this->objDetalle->getDato();
        $idmaestro=$this->objDetalle->getIdmaestro();

        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','MAESTRODETALLE','root','');

$comandoSql="insert into Detalle values('".$dato."','".$idmaestro."')";
         echo " Comando SQL : ". $comandoSql;

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

    function consultarDetalles(){
    $idmaestro=$this->objDetalle->getIdmaestro();
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','MAESTRODETALLE','root','');
        $comandoSql="select * from Detalle where idmaestro='".$idmaestro."'";
        $recordSet=$ObjConexion->ejecutarSql('MAESTRODETALLE',$comandoSql);
        $numRegistros = mysql_num_rows($recordSet);
        $mat[0][0]= $numRegistros;
        $i=0;
        while ($registro = mysql_fetch_array($recordSet)){
	          $i=$i+1;
              $mat[$i][0]=  $registro['ID'];
              $mat[$i][1]=  $registro['DATO'];
              $mat[$i][2]=  $registro['IDMAESTRO'];

               }
        mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);
        return $mat;
    }
     function consultarNumDetalles(){
    $idmaestro=$this->objDetalle->getIdmaestro();
        $ObjConexion=new CtrConexion();
        $enlace=$ObjConexion->conectar('localhost','MAESTRODETALLE','root','');
        $comandoSql="select * from Detalle where idmaestro='".$idmaestro."'";
        $recordSet=$ObjConexion->ejecutarSql('MAESTRODETALLE',$comandoSql);
        $numRegistros = mysql_num_rows($recordSet);
        mysql_free_result($recordSet);
        $ObjConexion->cerrar($enlace);
        return $numRegistros;
        }
 }


?>