<%-- 
    Document   : index
    Created on : 27/03/2020, 08:12:08 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/estilos.css" rel="stylesheet" type="text/css"/>
        <title>IMSS</title>
    </head>
    
    <body>
        <h1>PUNTO # 1 DEL SEGUNDO PARCIAL</h1>
        <br>
         <div>
             <form action="servletJubilacion" method="get">
                 <h3>DATOS DE LA PERSONA</h3>
                 <br>
                 <hr>
                 Nombre:<input type="text" name="Nombre">
                 <br>
                 Edad: <input type="text" name="Edad">
                 <br>
                 Antigüedad En La empresa: <input type="text" name="Antiguedad">
                 <br>
                 <input type="submit" name="Enviar" value="Enviar">
             </form>
        </div>
        <h2>HECHO POR:   </h2>
        <br>
        <h4>John Andrei Florez Valencia  </h4>
        
       
    </body>
</html>
