<?php
session_start();
include ("./Control/CtrConexion.php");
session_destroy();
header ("location: index.php");
exit;
?>