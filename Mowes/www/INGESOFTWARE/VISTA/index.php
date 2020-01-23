 <?
 session_start();    //se usa para mantener la sesion activa
 include("../modelo/funciones.php");

 $enlace=conectar();
 ?>

<body>


<table height="100%" width="100%" border="1">
<tr><td colspan="3"  width="10%"><? encabezado(); ?></td></tr>
<tr><td colspan="3" ><? login(); ?></td></tr>
<tr><td width="15%" valign="top"><? menu();?></td>
    <td><? contenido();?></td>
    <td width="15%"><?enlaces();?></td></tr>
<tr><td colspan="3"><?pie();?></td></tr>

</table>
<? mysql_close($enlace);?>
</body>