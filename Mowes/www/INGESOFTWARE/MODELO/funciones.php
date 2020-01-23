    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Laboratorio de Sonido USB</title>
	<link rel="stylesheet" type="text/css" href="../MODELO/CSS/sdmenu.css" />
    <link rel="stylesheet" type="text/css" href="../MODELO/CSS/carman_style.css">
    <script type="text/javascript" src="../MODELO/CSS/sdmenu.js">
		/***********************************************
		* Slashdot Menu script- By DimX
		* Submitted to Dynamic Drive DHTML code library: http://www.dynamicdrive.com
		* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
		***********************************************/
	</script>
	<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.init();
	};
	// ]]>
	</script>
  </head>

<?
function cuerpo(){
?>
<table align="center"><tr>
                    <td align="center"><img src="../MODELO/imagenes/labsonido.jpg"  alt="ingesonido" width="100%" height="100%"></td>



                </tr>


</table>
<?
}
?>







<?
function encabezado(){
?>
<table><tr>
                    <td align="center" valign="middle"><img src="../modelo/imagenes/ingesonido.jpg"  alt="ingesonido" width="100%" height="70%"></td>


                </tr>
</table>
<?
}






function login(){
?>  <table width="100%" border="1"><tr valign="middle"><td valign="middle" rowspan="2" >
    <form action="index.php" method="POST">
    Usuario: <input type="text" value="" name="login" maxlength="15" >
    clave: <input type="password" value="" name="clave" maxlength="15">
    <input type="submit" value="Aceptar" name="enviar" >
    <input type="reset" value="Borrar" >
    </form> </td><td valign="middle" align="center" onmouseover="this.style.background='red'" onmouseout="this.style.background='White'" ><b><??></b><br><a href='index.php?accion=out'>SALIR</a></td></tr>


    </table>
<?
}



function menu(){


    global $enlace,$sql,$resultado;

     if($_GET["accion"]=="hor"){   //calendrio de salas




    }


    if($_GET["accion"]=="out"){   //con esto cierro la sesion

       session_destroy();
      header("Location: index.php");
    }

      $login=$_POST["login"];
      $clave=$_POST["clave"];
      $perfil=$_SESSION["perfil"];
        if($_SESSION["perfil"]=="")
         {$perfil=3;
            //echo $perfil;
          }
        //else{echo$_SESSION["perfil"];}

        if($_POST["login"]!=""&&$_POST["clave"]!=""){
        $sql="select * from usuario where pklogin='".$_POST["login"]."' and clave='".$_POST["clave"]."'";
        $resultado=mysql_query($sql,$enlace);
        if($fila=mysql_fetch_array($resultado)){
        	$perfil=$fila["fkidperfil"];
            $_SESSION["perfil"]=$fila["fkidperfil"];
            $_SESSION["usuario"]=$fila["nombre"];
            $_SESSION["usu"]=$fila["idusuario"];

            //echo $_SESSION["perfil"];

        }else{
        	$perfil=3;
        }
    }





    /*else {

        $perfil=3;
    }*/

    $sql= "select menu.* from menu,perfilmenu where perfilmenu.fkidperfil=$perfil and menu.pkidmenu=perfilmenu.fkidmenu";
    $resultado=mysql_query($sql,$enlace);
    echo "<div style='float:left'id='my_menu' class='sdmenu'>";
    while($fila=mysql_fetch_array($resultado)){
    	if($fila["submenu"]==1){
    		echo "<div><span>".$fila["descripcion"]."</span>";
            $sql1="select * from submenu where fkidmenu=".$fila["pkidmenu"];
            $resulsub=mysql_query($sql1,$enlace);
            while($fila1=mysql_fetch_array($resulsub)){
                     echo "<a href='index.php?pagina=".$fila1["url"]."'>".$fila1["descripcion"]."</a>";
            }
            echo "</div>";
        }else {
	       echo "<div><span><a href='index.php?pagina=".$fila["url"]."'>".$fila["descripcion"]."</a></span></div>";
        }
    }
    echo "</div>";

}
function pie(){
	echo "<h1> pie </h1>";
}

function enlaces(){

global $enlace,$sql1,$resultado2;


            /*$sql3="select enlace.* from enlace where enlace.fkidperfil='1'";
            echo $sql3;
            $resultado=mysql_query($sql3,$enlace);

            while($fila2=mysql_fetch_array($resultado)){
                     echo $fila2["enlace.url"];
            }*/


            $sql1="select enlace.* from enlace where enlace.fkidperfil='1'";
            echo $sql1;
            $resultado2=mysql_query($sql1,$enlace);
            while($fila1=mysql_fetch_array($resultado2)){
                     echo "<a href='index.php?pagina=".$fila1["url"]."'>".$fila1["descripcion"]."</a>";
            }

       echo "<h1> Enlaces </h1>";
    }






function contenido(){
          //echo "la sesion actual es".$_SESSION["perfil"];
          //echo "<br>el perfil actual es".$perfil;

          $tags= array_keys($_GET); // obtiene los nombres de las varibles
          //echo  "el tag es".$tags[0];
          if($tags[0]==""){
             //$url="contenido/labsonido.jpg";
             //include_once($url);
             cuerpo();
          }
          if($tags[0]=="pagina"){
             $url=$_GET["pagina"];
             require_once($url);

          }
          if($tags[0]=="accion"){
             $url="../control/admusuarios.php";
             include_once($url);

          }
          if($tags[0]=="reserva"){
             $url="../control/calendario.php";
             include_once($url);

          }

          if($tags[0]=="hreserva"){
             $url="../control/reservar.php";
             include_once($url);

          }

}


function conectar()
{
	if(!($enlace=mysql_connect('localhost','root','')))
    {
    	echo 'error conexion con el servidor';
        exit();
    }
    if(!mysql_select_db("labsonido",$enlace))
    {
    	echo 'error seleccionando la BD';
        exit();
    }
   return $enlace;
}

?>

<?
