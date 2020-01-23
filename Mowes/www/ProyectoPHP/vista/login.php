   <?
	session_start();

     include("../modelo/Usuario.php");
     include("../control/CtrUsuario.php");
     include("../control/CtrConexion.php");
     $nomUsuario=".";
     $contrasena=".";
     $boton="";
	 $nomUsuario=$_POST["Usuario"];
	 $contrasena=$_POST["Contrasena"];
	 $boton=$_POST["login"];

     if($boton=="Ingresar"){

           try{
             $objUsuario=new Usuario($nomUsuario,$contrasena);
             $objCtrUsuario =new CtrUsuario($objUsuario);


             if($objCtrUsuario->validarIngreso()){
				$_SESSION["Usuario"]=$nomUsuario;
     		     header("location: Menu.php");
             }
             else{
                 echo "<script>alert(\"Usuario no válido\");</script>";
                }
             }
             catch(Exception $exp){
                    echo "ERROR ....R ".$exp->getMessage()."\n";
             }

    }
?>
