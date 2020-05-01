<%-- 
    Document   : index
    Created on : 28/02/2020, 06:25:56 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>EJERCICIO 1</title>
    </head>
    <body>
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
        <hr>
        <form action="Compra" method="get">
            <h1>   COMPRA   </h1>
            nombre: <input type="text" name="nombre">
            <br>
            apellido: <input type="text" name="apellido">
            <br>
            Valor: <input type="text" name="txtCantidad">
            <br>
            <input type="submit" name="btnCalcular" value="Calcular Costo">
            <br>
        </form>
        <hr>
         <form method="post" action="ThirdExcercice">
    <h1>Ejercicio 3</h1>
    Ingrese su nombre: <input type="text" name="empoyeeName">
    <br>
    Ingrese las horas trabajadas esta semana: <input type="text" name="hours">
    <br>
    <input type="submit" name="SendThirdExcercice" value="enviar">
  </form>
   
         <form action="sueldo" method="get">
            <h1>   COMPRA   </h1>
            Ingrese su nombre: <input type="text" name="empoyeeName">
            <br>
    Ingrese las horas trabajadas esta semana: <input type="text" name="hours">
    <br>
            <input type="submit" name="btnCalcular" value="Calcular Costo">
            <br>
        </form>
    </body>
</html>
