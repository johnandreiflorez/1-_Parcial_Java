<?php
    include("../MODELO/funciones1.php");
    $enlace=conectar1();




    //insertar
    switch($_GET["accion"]){
	    case insertar:

            $sql="INSERT INTO usuario(idusuario,nombre,apellido,telefono,direccion,correo,pklogin,clave,fecingreso,fecbaja,fkidperfil)
            values(".$_POST['idusuario'].",'".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['telefono']."','".$_POST['direccion']."','".
            $_POST['correo']."','".$_POST['pklogin']."','".$_POST['clave']."','".date('Y-m-d H:i')."','".date('Y-m-d H:i')."',".$_POST['fkidperfil'].")";
            mysql_query($sql,$enlace);

        break;


    // Actualizar
        case ACT:

            $sql="update usuario set
            idusuario='".$_POST["idus"]."',
            nombre='".$_POST["nom"]."',
            apellido='".$_POST["apell"]."',
            telefono='".$_POST["tele"]."',
            direccion='".$_POST["direc"]."',
            correo='".$_POST["cor"]."',
            pklogin='".$_POST["pklog"]."',
            clave='".$_POST["cla"]."',
            fecingreso='".$_POST["fecing"]."',
            fecbaja='".$_POST["fecb"]."',
            fkidperfil='".$_POST["fkidper"]."'
            where idusuario=".$_POST['idd'];
            mysql_query($sql,$enlace);
        break;

    //Borrar
        case DEL:
            $sql="delete from usuario where idusuario=".$_POST['idd'];
            mysql_query($sql,$enlace);
        break;
    //Buscar


     }



    //buscar
    echo "<form action='$PHP_SELF?accion=BUSCAR' method='POST'>";
    echo "<table align='center' border='1'>
        <tr><td>Buscar:<input type='text' value='' name='buscar'>
                       <input type='submit' value='buscar'></td></table></form>";
    //echo $_POST["buscar"];    //esta linea es para probar que el form esta haceindo buequeas

  //encabezado de la tabla
 echo "<table align='center' border='4' >
        <tr><th colspan=4>Usuarios</th><th colspan=3>Acciones</th> </tr>


        <tr align='center' bgcolor='#99FF00'>

        <td>IdUsuario</td>
        <td>Nombre</td>
        <td>Apellido</td>

        <td>Correo</td>

        <td colspan=3><a href='$PHP_SELF?accion=A'>Agregar</a></td>
       </tr>";


 // consulta

      $result=mysql_query("select * from usuario",$enlace);

        if($_GET["accion"]=='BUSCAR'){
            if($_POST["buscar"]!=""){
	            $sql="select * from usuario where
                    idusuario like'%".$_POST['buscar']."%' or
                    nombre like'%".$_POST['buscar']."%' or
                    apellido like'%".$_POST['buscar']."%' or
                    direccion like'%".$_POST['buscar']."%' or
                    telefono like'%".$_POST['buscar']."%' or
                    direccion like'%".$_POST['buscar']."%' or
                    correo like'%".$_POST['buscar']."%' or
                    pklogin like'%".$_POST['buscar']."%' or
                    clave like'%".$_POST['buscar']."%' or
                    fecingreso like'%".$_POST['buscar']."%' or
                    fecbaja like'%".$_POST['buscar']."%' or
                    fkidperfil like'%".$_POST['buscar']."%'";


            }
            else{
	            $sql="select * from usuario";
            }

            $result=mysql_query($sql,$enlace);

        }


 while($fila=mysql_fetch_array($result)){
    echo "<tr><td>".$fila["idusuario"]."</td>";
    echo "<td>".$fila["nombre"]."</td>";
    echo "<td>".$fila["apellido"]."</td>";
    //echo "<td>".$fila["telefono"]."</td>";
    //echo "<td>".$fila["direccion"]."</td>";
    echo "<td>".$fila["correo"]."</td>";
    //echo "<td>".$fila["pklogin"]."</td>";
    //echo "<td>".$fila["clave"]."</td>";
    //echo "<td>".$fila["fecingreso"]."</td>";
    //echo "<td>".$fila["fecbaja"]."</td>";
    //echo "<td>".$fila["fkidperfil"]."</td>";
    echo "<td><a href='$PHP_SELF?accion=v&id=".$fila["idusuario"]."'>Ver</a></td>";
    echo "<td><a href='$PHP_SELF?accion=m&id=".$fila["idusuario"]."'>Modificar</a></td>";
    echo "<td><a href='$PHP_SELF?accion=e&id=".$fila["idusuario"]."'>Eliminar</a></td>";

 }
  echo "</table></form>";


  switch ($_GET["accion"]) {
    case A:
         echo"<form action='$PHP_SELF?accion=insertar' method='POST'>
        <table align='center' border='1'>
        <tr><td>Idusuario:</td><td><input type='text' name='idusuario'></td>
        <tr><td>Nombre:</td><td><input type='text' name='nombre'></td></tr>
        <tr><td>Apellido:</td><td><input type='text' name='apellido'></td></tr>
        <tr><td>Telefono:</td><td><input type='text' name='telefono'></td></tr>
        <tr><td>Direccion:</td><td><input type='text' name='direccion'></td></tr>
        <tr><td>Correo:</td><td><input type='text' name='correo'></td>
        <tr><td>PkLogin:</td><td><input type='text' name='pklogin'></td></tr>
        <tr><td>Clave:</td><td><input type='text' name='clave'></td></tr>
        <tr><td>Fecha Ingreso:</td><td><input type='text' name='fecingreso'></td></tr>
        <tr><td>Fecha Baja:</td><td><input type='text' name='fecbaja'></td></tr>
        <tr><td>FkId Perfil:</td><td><input type='text' name='fkidperfil'></td>
        <tr><td><input type='submit' value='enviar'</td>
        <td><input type='button' value='cancelar' ONCLICK='history.go(-1)'></td></tr>
        </table>";

    break;
    case m:
        $sql="select * from usuario where idusuario=".$_GET["id"];
        $resultado=mysql_query($sql,$enlace);
        while($row=mysql_fetch_array($resultado)){
            echo"<form action='$PHP_SELF?accion=ACT' method='POST'>
           <table align='center'>
           <tr><td>Idusuario:</td><td><input type='text' name='idus' value='".$row['idusuario']."'></td>
            <tr><td>Nombre:</td><td><input type='text' name='nom' value='".$row['nombre']."'></td></tr>
            <tr><td>Apellido:</td><td><input type='text' name='apell' value='".$row['apellido']."'></td></tr>
            <tr><td>Telefono:</td><td><input type='text' name='tele' value='".$row['telefono']."'></td></tr>
            <tr><td>Direccion:</td><td><input type='text' name='direc' value='".$row['direccion']."'></td></tr>
            <tr><td>Correo:</td><td><input type='text' name='cor' value='".$row['correo']."'></td>
            <tr><td>PkLogin:</td><td><input type='text' name='pklog' value='".$row['pklogin']."'></td></tr>
            <tr><td>Clave:</td><td><input type='text' name='cla' value='".$row['clave']."'></td></tr>
            <tr><td>Fecha Ingreso:</td><td><input type='text' name='fecing' value='".$row['fecingreso']."'></td></tr>
            <tr><td>Fecha Baja:</td><td><input type='text' name='fecb' value='".$row['fecbaja']."'></td></tr>
            <tr><td>FkId Perfil:</td><td><input type='text' name='fkidper' value='".$row['fkidperfil']."'></td>";
           }
            echo
            "

            <tr><td><input type='submit' value='Actualizar'><input type='hidden' name='idd' value=".$_GET['id']."></td>

            <td><input type='button' value='Cancelar' ONCLICK='history.go(-1)'></td></tr>
            </table>";
            break;

    case e:
        $sql="select * from usuario where idusuario=".$_GET["id"];
        $resultado=mysql_query($sql,$enlace);
        while($row=mysql_fetch_array($resultado)){
            echo"
           <table alig=center>
           <tr><td>Idusuario:</td><td>".$row['idusuario']."</td>
            <tr><td>Nombre:</td><td>".$row['nombre']."</td></tr>
            <tr><td>Apellido:</td><td>".$row['apellido']."</td></tr>
            <tr><td>Telefono:</td><td>".$row['telefono']."</td></tr>
            <tr><td>Direccion:</td><td>".$row['direccion']."</td></tr>
            <tr><td>Correo:</td><td>".$row['correo']."</td>
            <tr><td>PkLogin:</td><td>".$row['pklogin']."</td></tr>
            <tr><td>Clave:</td><td>".$row['clave']."</td></tr>
            <tr><td>Fecha Ingreso:</td><td>".$row['fecingreso']."</td></tr>
            <tr><td>Fecha Baja:</td><td>".$row['fecbaja']."</td></tr>
            <tr><td>FkId Perfil:</td><td>".$row['fkidperfil']."</td>";
            }
            echo  "
            <form action='$PHP_SELF?accion=DEL' method='POST'>
            <table align='center' border='1'>
            <tr><td>Esta seguro que desea eliminar este usuario?</td>
                <td><input type='submit' name=si value='Si'><input type='hidden' name='idd' value=".$_GET['id']."></td>
                <td><input type='button' value='No' ONCLICK='history.go(-1)'></td>
            </tr>
            </table>
            </form>";
          break;



    default:

  }
  mysql_free_result($result);


?>