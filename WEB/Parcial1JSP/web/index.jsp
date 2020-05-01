<%-- 
    Document   : index
    Created on : 28/02/2020, 08:39:56 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
        <form action="servletParcial" method="get">
            <h1>PARCIAL #1</h1>
            <br>
            Nombre: <input  type="text" name="nombre">
            <br>
            Cantidad de Tornillos Producidos: <input  type="text"  name="TotalTornillos">
            <br>
            Cantidad de Tornillos Defectuoso: <input type="text"  name="TornillosDefectuosos">
            <br>
            <input type="submit" name="SendThirdExcercice" value="enviar">
        </form>
    </body>
</html>
