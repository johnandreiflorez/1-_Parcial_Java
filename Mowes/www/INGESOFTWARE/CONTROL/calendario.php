<?php
    include("../modelo/funciones1.php");
     $enlace=conectar1();




?>


<table align="center">
<?echo "<form action='$PHP_SELF?reserva=hor' method='POST'>";?>

  <tr>
    <td><?calendario()?></td>
  </tr>
  <tr align="center">
    <td><input type='submit' value='Consultar'></td>

  </tr>

</form>
</table>


<?   IF($_GET["reserva"]==rese){


            $sql="INSERT INTO sala_horario(fkid_sala,fkid_horario,fkid_usuario,fecha)
            values(".$_POST['sala'].",'".$_POST['hor']."','".$_POST['nom']."','".$_POST['fech']."')";
            mysql_query($sql,$enlace);

            ?>
            <table border="0">

        <tr><td colspan="7"  valign="middle" align="center" bgcolor="#CCCCCC"><h1><?echo$_POST["fech"]?></h1></td></tr>
        <tr bgcolor="#CCCC99" align="center" valign="middle"><td><h3>SALAS</h6></td>

   <?
   $result=mysql_query("select * from horario",$enlace);




    while($fila=mysql_fetch_array($result)){
    echo "<td ><h6>".$fila["ini_hora"]." - ".$fila["fin_hora"]."</h6></td>";
    }
    echo "</tr>";
    ?>

  <?
      $sql1="select * from sala";



      $result=mysql_query($sql1,$enlace);



      while($fila=mysql_fetch_array($result)){

        echo "<tr><td bgcolor='#FFCC33'>".$fila["sala"]."</td>"; //muestra las salsa que tiene el edificio

        $sql2="select * from horario";
        $result1=mysql_query($sql2,$enlace);
        while($fila1=mysql_fetch_array($result1)){

              $sql3="select * from sala_horario where fecha='".$_POST["fech"]."'";
              $result2=mysql_query($sql3,$enlace);
              while($fila2=mysql_fetch_array($result2)){
                      $p=$fila1;
              	    if($fila["id_sala"]==$fila2["fkid_sala"] and $fila1["id_horario"]==$fila2["fkid_horario"]){

                   echo "<td bgcolor='Red' align='center'>Reservado</td>";
                   if($p==''){}
	                else{
                       $fila1=mysql_fetch_array($result1);}
                 }

               }



               echo "<td align='center' bgcolor='#99FF33'";
               ?>
               onmouseover="this.style.background='#009966'" onmouseout="this.style.background='#99FF33'">
               <?
               echo "<a href='$PHP_SELF?hreserva&s=".$fila["id_sala"]."&h=".$fila1["id_horario"]."&fecha=".$_POST["fech"]."'>Reservar</a></td>";





        }
        echo "</tr>";
    }
  echo "</table>";




      }

        /////////////////////////////////////////////////////////////
      else{

      if($_GET["reserva"]=='hor'){?>

        <table border="0">

        <tr><td colspan="7"  valign="middle" align="center" bgcolor="#CCCCCC"><h1><?echo $_POST["enddate"]?></h1></td></tr>
        <tr bgcolor="#CCCC99" align="center" valign="middle"><td><h3>SALAS</h6></td>

   <?
   $result=mysql_query("select * from horario",$enlace);




    while($fila=mysql_fetch_array($result)){
    echo "<td ><h6>".$fila["ini_hora"]." - ".$fila["fin_hora"]."</h6></td>";
    }
    echo "</tr>";
    ?>

  <?
      $sql1="select * from sala";



      $result=mysql_query($sql1,$enlace);



      while($fila=mysql_fetch_array($result)){

        echo "<tr><td bgcolor='#FFCC33'>".$fila["sala"]."</td>"; //muestra las salsa que tiene el edificio

        $sql2="select * from horario";
        $result1=mysql_query($sql2,$enlace);
        while($fila1=mysql_fetch_array($result1)){

              $sql3="select * from sala_horario where fecha='".$_POST["enddate"]."'";
              $result2=mysql_query($sql3,$enlace);
              while($fila2=mysql_fetch_array($result2)){
                    $p=$fila1;
              	    if($fila["id_sala"]==$fila2["fkid_sala"] and $fila1["id_horario"]==$fila2["fkid_horario"]){

                   echo "<td bgcolor='Red' align='center'>Reservado</td>";
                   if($p==''){}
	                else{
                       $fila1=mysql_fetch_array($result1);}
                 }

               }



               echo "<td align='center' bgcolor='#99FF33'";
               ?>
               onmouseover="this.style.background='#009966'" onmouseout="this.style.background='#99FF33'">
               <?
               echo "<a href='$PHP_SELF?hreserva&s=".$fila["id_sala"]."&h=".$fila1["id_horario"]."&fecha=".$_POST["enddate"]."'>Reservar</a></td>";





        }
        echo "</tr>";
    }
  echo "</table>";


   }

   }

    ////////////////////////////////////////////// mostrar la confirmacion de la reserva

     if($_GET["reserva"]=='res'){?>

<table border="0">

<tr><td colspan="7"  valign="middle" align="center" bgcolor="#CCCCCC"><h1><?echo $_POST["enddate"]?></h1></td></tr>



<tr bgcolor="#CCCC99" align="center" valign="middle"><td><h3>SALAS</h6></td>

   <?
   $result=mysql_query("select * from horario",$enlace);




    while($fila=mysql_fetch_array($result)){
    echo "<td ><h6>".$fila["ini_hora"]." - ".$fila["fin_hora"]."</h6></td>";
    }
    echo "</tr>";
    ?>

  <?
      $sql1="select * from sala";



      $result=mysql_query($sql1,$enlace);



      while($fila=mysql_fetch_array($result)){

        echo "<tr><td bgcolor='#FFCC33'>".$fila["sala"]."</td>"; //muestra las salsa que tiene el edificio

        $sql2="select * from horario";
        $result1=mysql_query($sql2,$enlace);
        while($fila1=mysql_fetch_array($result1)){

              $sql3="select * from sala_horario where fecha='".$_POST["enddate"]."'";
              $result2=mysql_query($sql3,$enlace);
              while($fila2=mysql_fetch_array($result2)){
                     $p=$fila1;
              	    if($fila["id_sala"]==$fila2["fkid_sala"] and $fila1["id_horario"]==$fila2["fkid_horario"]){

                   echo "<td bgcolor='Red' align='center'>Reservado</td>";
                   if($p==''){}
	                else{
                       $fila1=mysql_fetch_array($result1);}
                 }

               }



               echo "<td align='center' bgcolor='#99FF33'";
               ?>
               onmouseover="this.style.background='#009966'" onmouseout="this.style.background='#99FF33'">
               <?
               echo "<a href='$PHP_SELF?hreserva&s=".$fila["id_sala"]."&h=".$fila1["id_horario"]."&fecha=".$_POST["enddate"]."'>Reservar</a></td>";





        }
        echo "</tr>";
    }
  echo "</table>";


   }




?>