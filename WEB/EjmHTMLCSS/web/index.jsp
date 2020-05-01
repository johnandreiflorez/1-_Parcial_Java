<%-- 
    Document   : index
    Created on : 13/03/2020, 08:14:17 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/estilos.css" rel="stylesheet" type="text/css"/>
        <title>JSP Page</title>
    </head>
    <body>
        <form action="servletHTMLCSS" method="get">
            <%--demostraciones de radio botones de opciones--%>
            <h1> Demostraciones  de  radio  button o botones de opciones</h1>
            <br>
            <%-- la primer opcion activa con el CHECKED--%>
            <input type="radio" value="Windows" name="optSistemaOperativo" checked>Windows
            <br>
            <input type="radio" value="Linux" name="optSistemaOperativo">Linux
            <br>
            <input type="radio" value="Mac" name="optSistemaOperativo">Mac
            <br>
            <br>
            <%--Demostracion  de listados desplegables o combobox--%>
            <h1>Demostracion  de listados desplegables o combobox</h1>
            <br>
            <%--puede seleccionar uno--%>
            <select name="cmbColor">
                <option>Amarillo</option>
                <option>Azul</option>
                <option>Rojo</option>
                <option>Verde</option>
            </select>
            <br>
            <br>
            <%--Demostracion checkbox--%>
            <h1>Demostracion checkbox</h1>
            <br>
            <%--(puede seleccionar uno, varios o ninguno)--%>
            <input type="checkbox" name="chkControl" value="Corre">Deseo Recibir info a mi correo
            <br>
            <input type="checkbox" name="chkControl" value="Contrato">Acepto terminos de contrato
            <br>
            <br>
            
            <input type="submit" name="btnEnviar" value="Enviar">   s       
                  
        </form>
    </body>
</html>
