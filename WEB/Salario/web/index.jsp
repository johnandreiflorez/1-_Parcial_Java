<%-- 
    Document   : index
    Created on : 27/03/2020, 09:28:21 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>SALARIO</title>
    </head>
    <body>
         <h1>PUNTO # 2 DEL SEGUNDO PARCIAL</h1>
        <br>
         <div>
             <form action="servletSalario" method="get">
                 <h3>DATOS DE LA PERSONA</h3>
                 <br>
                 <hr>
                 Nombre:<input type="text" name="Nombre">
                 <br>
                 Salario: <input type="text" name="Salario">
                 <br>
                 <input type="submit" name="Enviar" value="Enviar">
             </form>
        </div>
        <h2>HECHO POR:   </h2>
        <br>
        <h4>John Andrei Florez Valencia  </h4>
    </body>
</html>
