   <?
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
	 
	 function Consultar()
	{
		$objUsuario=new Usuario($nomUsuario,"");	
		 $objCtrUsuario=new CtrUsuario($objUsuario);
		 $objUsuario = $objCtrUsuario->Consultar();
		 $nomUsuario=$objUsuario->getNomUsuario();
		 $contrasena=$objUsuario->getContrasena();
		 
	}
	  
  try{
    $nomUsuario=$_POST["Usuario"];
    $contrasena=$_POST["Contrasena"];
    $boton=$_POST["boton"];
   
   if($boton =="consultar"){

             $objUsuario=new Usuario($nomUsuario,"");
             $objCtrUsuario =new CtrUsuario($objUsuario);
             $objUsuario = $objCtrUsuario->consultar();
             //momentanea por felipe 
			 $contrasena=$objUsuario->getContrasena();
             //$ArrayUsuarios = $objCtrUsuario->listar();
             //momentaneo por felipe $tam = $ArrayUsuarios[0][0];
			 $nombreUsuario=$objUsuario->getNomUsuario();
			 $contrasena=$objUsuario->getContrasena();
			 echo  $nomUsuario;
			 echo  $contrasena;
			 
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
   
   if($boton =="borrar"){
    	    $objUsuario=new Usuario($nomUsuario,$contrasena);
    	    $objCtrUsuario=new CtrUsuario($objUsuario);
    	    $objCtrUsuario->borrar();
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

echo 
"<html>
<head>
<link rel=\"StyleSheet\" href=\"../EstilosJS/estilos.css\" type=\"text/css\">
<script type=\"text/javascript\" src=\"../EstilosJS/jquery.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/funciones.js\"></script>
<script type=\"text/javascript\" src=\"../EstilosJS/validarUsuario.js\"></script>
<center>
             <div>
                <img alt=\"itm\" src=\"../Imagenes/logo04-002.jpg\"
                style=\"width: 900px; height: 110px\"/>
             </div>
</center>
</head>

<body>
<form name=\"frmUsuarios\" action=\"VUsuarios.php\" method=\"post\">
<table align=\"center\" border=\"1\" >
<tr>
<td align=\"center\" colspan=\"2\"><b> MANEJO DE USUARIOS </b>
</td>
</tr>
<tr>
<td>Usuario</td>
<td><input type=\"text\" name=\"Usuario\" VALUE =\"".$nomUsuario."\" ID=\"nomUsuario\" /></td>
</tr>
<tr>
<td>Passwor</td>
<td><input type=\"password\" name=\"Contrasena\" VALUE =\"".$contrasena."\" ID=\"contrasena\" /></td>
</tr>
<center>
<table align=\"center\">
<tr>
 <td><input type=\"submit\" class=\"boton\" name=\"boton\" value=\"consultar\" ID=\"consultar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"boton\" value=\"modificar\" ID=\"modificar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"boton\" value=\"borrar\" ID=\"borrar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"boton\" value=\"insertar\" ID=\"insertar\" ></td>
 <td><input type=\"submit\" class=\"boton\"  name=\"boton\" value=\"listar\" ID=\"listar\" ></td>
</tr>
</table>
</center>
</form>
</body>";


             $x="<center><table border='1' ><tr><td>Usuario</td><td>Contraseña</td></tr>";
              for($cont=1;$cont<= $tam;$cont++){
              		$x=$x."<tr><td>".$ArrayUsuarios[$cont][0]."</td><td>".$ArrayUsuarios[$cont][1]."</td></tr>";
              }
              $x=$x."</table></center>";
              // SE MUESTRA EL CONTENIDO DE X, QUE ES UNA TABLA HTML CON LOS DATOS DE LA MATRIZ
              echo $x;

   ?>

