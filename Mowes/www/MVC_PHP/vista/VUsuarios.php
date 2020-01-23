   <?
   session_start();
    echo "Usuario=".$_SESSION['Usu'];
 echo "Contrseña". $_SESSION['Con'];
   include("../modelo/Usuario.php");
   include("../control/CtrUsuario.php");
   include("../control/CtrConexion.php");
     $nomUsuario="";
     $contrasena="";
     $boton="";
     $ArrayUsuarios = null;
     $x="";
     $cont=0;
     $tam=0;
  try{
    $nomUsuario=$_POST["Usuario"];
    $contrasena=$_POST["Contrasena"];
    $boton=$_POST["boton"];
   if($boton =="consultar"){

             $objUsuario=new Usuario($nomUsuario,"");
             $objCtrUsuario =new CtrUsuario($objUsuario);
             $objUsuario = $objCtrUsuario->consultar();
             $contrasena=$objUsuario->getContrasena();
             $ArrayUsuarios = $objCtrUsuario->listar();
             $tam = $ArrayUsuarios[0][0];
    }
   if($boton =="modificar"){
    	    $objUsuario=new Usuario($nomUsuario,$contrasena);
    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->modificar();
             $nomUsuario=$objUsuario->getNomUsuario();
             $contrasena=$objUsuario->getContrasena();
             $ArrayUsuarios = $objCtrUsuario->listar();
             $tam = $ArrayUsuarios[0][0];
    }
   if($boton =="insertar"){
    	    $objUsuario=new Usuario($nomUsuario,$contrasena);
    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->guardar();
             $nomUsuario=$objUsuario->getNomUsuario();
             $contrasena=$objUsuario->getContrasena();
             $ArrayUsuarios = $objCtrUsuario->listar();
             $tam = $ArrayUsuarios[0][0];
    }
   if($boton =="borrar"){
    	    $objUsuario=new Usuario($nomUsuario,$contrasena);
    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->borrar();
             $nomUsuario=$objUsuario->getNomUsuario();
             $contrasena=$objUsuario->getContrasena();
             $ArrayUsuarios = $objCtrUsuario->listar();
             $tam = $ArrayUsuarios[0][0];
    }
   if($boton =="listar"){
             $objUsuario=new Usuario('','');
             $objCtrUsuario =new CtrUsuario($objUsuario);
             $ArrayUsuarios = $objCtrUsuario->listar();
             $tam = $ArrayUsuarios[0][0];
     }

  }
      	catch (Exception $exp)
      	{
          	echo "ERROR SELECCIONANDO LA BASE DE DATOS".$exp->getMessage()."\n";
        }

echo "<form name=\"frmLogin\" action=\"VUsuarios.php\" method=\"post\">".
"<table align=\"center\" border=\"1\" >".
"<tr>".
"<td align=\"center\" colspan=\"2\"><b> MANEJO DE USUARIOS </b>".
"</td>".
"</tr>".
"<tr>".
"<td>Usuario</td>".
"<td><input type=\"text\" name=\"Usuario\" VALUE =".$nomUsuario." ID=\"Text1\" /></td>".
"</tr>".
"<tr>".
"<td>Passwor</td>".
"<td><input type=\"text\" name=\"Contrasena\" VALUE =".$contrasena." ID=\"Text2\" /></td>".
"</tr>".
"<center>".
"<table>".
"<tr>".
 "<td><input type=\"submit\" name=\"boton\" value=\"consultar\" ></td>".
 "<td><input type=\"submit\" name=\"boton\" value=\"modificar\" ></td>".
 "<td><input type=\"submit\" name=\"boton\" value=\"borrar\" ></td>".
 "<td><input type=\"submit\" name=\"boton\" value=\"insertar\"></td>".
 "<td><input type=\"submit\" name=\"boton\" value=\"listar\"></td>".
"</tr>".
"</table>".
"</center>".
"</form>";


             $x="<center><table border='1' ><tr><td>Usuario</td><td>Contraseña</td></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayUsuarios[$cont][0]."</td><td>".$ArrayUsuarios[$cont][1]."</td></tr>";
              }
              $x=$x."</table></center>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;

   ?>

