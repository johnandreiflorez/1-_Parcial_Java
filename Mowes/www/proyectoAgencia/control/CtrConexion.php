<?

class CtrConexion{
			var $enlace;
    function conectar($servidor, $db,$usuario, $password){

    	try
      	{
            $enlace=mysql_connect($servidor, $usuario, $password);
      	}
      	catch (Exception $e)
      	{
          	echo "ERROR AL CONECTARSE AL SERVIDOR ".$e->getMessage()."\n";

      	}
      	try
      	{
        	mysql_select_db($db, $enlace);

      	}
      	catch (Exception $e)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$e->getMessage()."\n";
        }
      	return $enlace;
    }

    function cerrar($enlace)
    {
        mysql_close($enlace);
    }

    function ejecutarSql($db, $consulta)
    {
    	try
    	{
        	$recordSet=mysql_db_query($db, $consulta);
    	}
    	catch (Exception $e)
    	{
          	echo " NO SE AFECTARON LOS REGISTROS: ". $e->getMessage()."\n";
        }
    	return $recordSet;
    }
}
?>
