<?php
if(!isset($_SESSION['pass'])
header("location: login.php");
$raiz = "http://localhost:81/softech/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="http://omarserver.no-ip.org/dominios/favicon.ico">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Softech Helpdesk</title>
<link type="text/css" rel="stylesheet" href="<?php echo $raiz; ?>CSS/principal.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $raiz; ?>CSS/planes.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $raiz; ?>CSS/contactenos.css" />
</head>
<body>
 <div id="manejo1">
  <div id="manejo2">
    <div align="center">
    <div id="principal">
    <div class="logo">
    <a href="<?php echo $raiz; ?>">
     <img src="<?php echo $raiz; ?>Imagenes/Logo.png"  style="border:none;" /></a>
    <span class="imagenderecha"><img src="<?php echo $raiz; ?>Imagenes/ImagenSuperior.png" alt="" /></span></div>
    <div class="imagenderecha">
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    </div>
<div id="divmenu">
     <table width="100%" cellpadding="0" cellspacing="0">
     <tr>
      <td colspan="2">
        <ul id="ulmenu">
        <li>
          <a href="<?php echo $raiz; ?>Inicio.php">Inicio</a></li>
        <li>
          <a href="<?php echo $raiz; ?>Usuario.php">Usuarios</a></li>
        <li>
          <a href="<?php echo $raiz; ?>Responsable.php">Técnicos</a></li>
        <li>
          <a href="<?php echo $raiz; ?>incidente.php">Incidente</a></li>
        <li>
          <a href="<?php echo $raiz; ?>contactenos.php">Cont&aacute;ctenos</a></li>
        <li>
        <a href="<?php echo $raiz; ?>logout.php">Cerrar Sesion</a></li>
        </ul>
       </td>
     </tr>
    </table>
    </div>  