<%-- 
    Document   : compra
    Created on : 21/03/2020, 06:50:25 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/estilo.css" rel="stylesheet" type="text/css"/>
        <title>COMPRA DE PRODUCTO</title>
    </head>
    <body>
        <h1>PUNTO #1 DEL TALLER</h1>
        
        <br>
        <br>
        <form action="servletCompra" method="get">
            Nombre:<input type="text" name="Nombre">
            <br>
            Apellido:<input type="text" name="Apellido"> 
            <br><hr>
            <h3>¿Que llevaras?</h3>
            <br>
            Producto:<input type="text" name="Producto">
            <br>
            Valor:<input type="text" name="Valor">
            <br>
            Cantidad:<input type="text" name="Cantidad">
            <br>
            <input type="submit" name="btnAgregar" value="Agregar">
            <br>
        </form>
        <form action="index.jsp" method="pop">
             <input type="submit" name="btnCancelar" value="Cancelar">
        </form>
        <br>
        <br>
        <a href="index.jsp">Volver al Incio</a> 
    </body>
</html>
