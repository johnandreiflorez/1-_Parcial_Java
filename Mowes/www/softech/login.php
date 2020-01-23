<?
if (!session_id())
 session_start();

       include("Modelo/Responsable.php");
       include("Control/CtrResponsable.php");
       include("Control/CtrConexion.php");
     $nomUsuario=".";
     $contrasena=".";
     $boton="";
	 $nomUsuario=$_POST["txtusuario"];
	 $contrasena=$_POST["txtcontrasena"];

	 $boton=$_POST["btnenviar"];

     if($boton=="enviar"){

           try{
             $objResponsable=new Responsable('','','','','','','',$nomUsuario,$contrasena,'');
             $objCtrResponsable =new CtrResponsable($objResponsable);


             if($objCtrResponsable->validarIngreso()== true){

                 echo "<center> <h1>USUARIO VÁLIDO</h1></center>";
                         $_SESSION['usuario']=$nomUsuario;
                         $_SESSION['pass']= $contrasena;
                        header("location: Inicio.php");

                 }
             else{
                  header("location: Index.php");
                                echo "<center> <h1>USUARIO NO VÁLIDO</h1></center>";
                }
             }
             catch(Exception $exp){
                    echo "ERROR ....R ".$exp->getMessage()."\n";
             }

    }
?>











