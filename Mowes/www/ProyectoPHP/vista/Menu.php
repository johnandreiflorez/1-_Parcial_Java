<?
	session_start();
	echo $_SESSION["Usuario"];
	
	if (!isset($_SESSION['Usuario']))
    {
		header("location: index.html");
		exit;
    }
?>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<title>MENU</title>

<link href="style.css" rel="stylesheet" type="text/css">
<link rel="StyleSheet" href="../EstilosJS/menuu.css" type="text/css">

</head>

<body>
<div id="wrap">
<section id="left">
	<header id="mainheader">
	<img src="../Imagenes/logo.jpg" width="250" height="120" alt="Yameya">
    <h1 id="sitename"></h1>
    </header>

    
    <section id="sidebar">
    <div class="sb-block">
    <img src="../Imagenes/buspas.png" width="182" height="174" alt="css heaven free css templates">
    </div>
    
    <div class="sb-block">
    <h2>Men&uacute;</h2>
    <ul>
	<h3>
    	<li><A href="VUsuarios.php">Usuarios </A></li>
		<li><A href="VCliente.php">Clientes </A></li>
		<li><A href="VVehiculo.php">Veh&iacute;culo </A></li>
		<li><A href="VTipVehiculo.php">Tipo Veh&iacute;culo </A></li>
		<li><A href="VViaje.php">Viajes </A></li>
		<li><A href="VRuta.php">Ruta </A></li>
		<li><A href="VReserva.php">Reserva </A></li>
	</h3>
    </ul>
    </div>
    
    
    
    </section>
</section>

<section id="right">
	<header id="pageheader">
   		<div id="intro">
        	<div id="introwrap">
            <h2>Quienes Somos</h2>
            <p>La confianza que los usuarios tienen por nuestra compa&ntilde;&iacute;a se basa en las inmejorables caracter&iacute;sticas del servicio que ofrecemos, lo que nos hace &Uacute;nicos en el sector del transporte en Colombia. </p>
            </div>
                    <a href="#" class="resume">Download Resume</a>

        </div>
    </header>
    
    <section id="contents">
    <section id="homemain">
    <article class="post">
    <header>
    <h2><a href="#">Y A M E Y A</a></h2>    
    </header>
    <div class="entry">
    
    <p></a></p>
    
    </div>
    </article>
    
    <article class="post">
    <header>
    <h2><a href="#">Misi&oacute;n</a></h2>
    
    </header>
    <div class="entry">
    
    <p>Somos una cooperativa de transporte terrestre de pasajeros, carga, recomendados y encomiendas, prestando un servicio de excelente calidad a nuestros asociados y clientes.</p>
    
    </div>
    </article>
    
    <article class="post">
    <header>
    <h2><a href="#">Visi&oacute;n</a></h2>
    </header>
    <div class="entry">
    
    <p>Ser la cooperativa preferida por los colombianos, por su excelente servicio y gesti&oaute;n social</p>
    
    </div>
    </article>

    
    </section>
    <section id="photos">
    <h2 class="subhead">Yarumal</h2>
    <div class="imagepost">
    <img src="../Imagenes/yarumal.jpg" height="113" alt="rain">
    <p class="caption"><a href="http://www.yarumal.gov.co/">Municipio Yarumal</a></p>
    </div>
    
    <div class="imagepost">
    <img src="../Imagenes/bus.jpg" width="170" height="113" alt="rain">
    <p class="caption"><a href="#">It Rained Last Night</a></p>
    </div>
    
    <div class="imagepost">
    <img src="../Imagenes/buseta.png" width="170" height="113" alt="rain">
    <p class="caption">Nuestros buses</p>
    </div>
</section>
    
    <div class="clear"></div>
    </section>
</section>
<div class="clear"></div>
</div>
<footer id="pagefooter">

<div id="footerwrap">



<div id="tools">
<h2>Y A M E Y A</h2>
<img src="../Imagenes/logo.jpg" width="135" height="36" alt="view more">
</div>
<div class="clear"></div>
</div>

</footer>
</body>
</html>