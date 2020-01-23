<?php
    include("../modelo/funciones1.php");
     $enlace=conectar1();



   //insertar


             $sql1="select * from horario where id_horario=".$_GET["h"];
            $result=mysql_query($sql1,$enlace);
            while($fila1=mysql_fetch_array($result)){
                    $hora=$fila1["ini_hora"]."-".$fila1["fin_hora"];
            }



        echo"
            <table align='center' border='0'>
               <form action='$PHP_SELF?reserva=rese' method='POST'>
                <tr bgcolor='#CCCC66'><td colspan='2'align='center'><h3>Confirmar Reserva</h3></td></tr>
                <tr bgcolor='#FFCC33'><td>Usuario:</td><td><input type='text' name='nom' value='".$_SESSION["usu"]."'></td></tr>
                <tr bgcolor='#FFCC33'><td>Sala:</td><td><input type='text' name='sala' value='".$_GET["s"]."'></td></tr>
                <tr bgcolor='#FFCC33'><td>Horario:</td><td><input type='text' name='hora' value='".$hora."'></td></tr>
                <tr bgcolor='#FFCC33'><td>Fecha:</td><td><input type='text' name='fech' value='".$_GET["fecha"]."'></td></tr>
                <tr bgcolor='#FFCC33'><td><input type='submit' value='Aceptar'><input type='hidden' name='hor' value=".$_GET['h']."></td>
                <td><input type='button' value='cancelar' ONCLICK='history.go(-1)'></td></tr>
            </form></table>";







     ?>
