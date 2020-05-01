<%-- 
    Document   : index
    Created on : 14/02/2020, 08:33:39 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>First: Suma</title>
    </head>
    <body>
<%--se usa la etiqueta "action" para hacer referencia a el Servlet--%>
 <%--        <form action="servletPrueba" method="get">
            
            Digire el texto  numero: <input type="text" name="txtPrimerNumero">
            <br>
            digite el segundo numero: <input type="text" name="txtSegundoNumero">
            <br>
            <input type="submit" name="btnSuma" value="Sumar">
            <br>
            <input type="submit" name="btnResta" value="Resta">
            <br>
        </form>--%>
        
        <form action="servletLlantera" method="get">
            <h1>LLANTERA</h1>
            nombre: <input type="text" name="nombre">
            <br>
            apellido: <input type="text" name="apellido">
            <br>
            cantidad a comprar: <input type="text" name="txtCantidad">
            <br>
            <input type="submit" name="btnCalcular" value="Calcular Costo">
            <br>
        </form>
    </body>
</html>
