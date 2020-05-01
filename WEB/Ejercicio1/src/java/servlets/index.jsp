<%--
  Created by IntelliJ IDEA.
  User: Alejo
  Date: 28/02/2020
  Time: 1:57 PM
  To change this template use File | Settings | File Templates.
--%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<html>
  <head>
    <title>Taller Servlets</title>
  </head>
  <body>
  <form method="post" action="FirstExcercice">
    <h1>Ejercicio 1</h1>
    <br>
    ¿Cuantas llantas desea comprar?
    <input type="text" name="nroLlantas">
    <br>
    <input type="submit" name="SendFirstExcercice" value="enviar">
  </form>
  <hr/>
  <form method="post" action="SecondExcercice">
    <h1>Ejercicio 2</h1>
    Ingrese su nombre: <input type="text" name="name">
    <br>
    Ingrese su apellido: <input type="text" name="lastName">
    <br>
    valor de la compra: <input type="text" name="value">
    <br>
    <input type="submit" name="SendSecondExcercice" value="enviar">
  </form>
  <hr/>
  <form method="post" action="ThirdExcercice">
    <h1>Ejercicio 3</h1>
    Ingrese su nombre: <input type="text" name="empoyeeName">
    <br>
    Ingrese las horas trabajadas esta semana: <input type="text" name="hours">
    <br>
    <input type="submit" name="SendThirdExcercice" value="enviar">
  </form>
  </body>
</html>
