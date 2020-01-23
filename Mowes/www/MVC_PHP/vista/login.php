   <?
   session_start();
       include("../modelo/Usuario.php");
       include("../control/CtrUsuario.php");
       include("../control/CtrConexion.php");
     $nomUsuario=".";
     $contrasena=".";
     $boton="";
	 $nomUsuario=$_REQUEST["Usuario"];
	 $contrasena=$_POST["Contrasena"];
	 $boton=$_POST["boton"];

     if($boton=="enviar"){

           try{
             $objUsuario=new Usuario($nomUsuario,$contrasena);
             $objCtrUsuario =new CtrUsuario($objUsuario);


             if($objCtrUsuario->validarIngreso()== true){

                    $_SESSION['Usu']=  $nomUsuario;
                    $_SESSION['Con']=  $contrasena;
                    header("location: Menu.php");
       



             }
             else{
                echo "<center> <h1>USUARIO NO VÁLIDO</h1></center>";
                }
             }
             catch(Exception $exp){
                    echo "ERROR ....R ".$exp->getMessage()."\n";
             }

    }
?>
