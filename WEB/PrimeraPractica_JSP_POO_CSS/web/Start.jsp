<%-- 
    Document   : Start
    Created on : 13/04/2020, 10:17:08 PM
    Author     : Andrei Florez V
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="CSS/Styles.css" rel="stylesheet" type="text/css"/>
        <%-- <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script>
            $(document).ready(function() {
		$('#submit').click(function(event) {
			var nombreVar = $('#Nombre').val();
			var apuestaVar = $('#Apuesta').val();
			var caballoVar = $('#Caballo').val();
			// Si en vez de por post lo queremos hacer por get, cambiamos el $.post por $.get
			$.get('TableBettorServlet', {
				nombre : nombreVar,
				apuesta: apuestaVar,
				caballo: caballoVar
			}, function(responseText) {
				$('#tabla').html(responseText);
			});
		});
            }); --%>
        </script>
        <title>JSP Page</title>
    </head>
    <body>
        <div class="">
            <table border="solid">
                <tr>
                    <th>ID CABALLO</th>
                    <th>NOMBRE DEL CABALLO</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Pegazo</th>
                </tr>
                <tr>
                    <th>2</th>
                    <th>Zeus</th>
                </tr>
                <tr>
                    <th>3</th>
                    <th>Perseo</th>
                </tr>
                <tr>
                    <th>4</th>
                    <th>Dante</th>
                </tr>
            </table>
            <br>
            <div class="data">
                <form action="TableBettorServlet" method="get" id="fomr1">
                    <fieldset>
                        <legend>Registro</legend>
                        <label for="Nombre">Nombre: </label>
                        <input type="text" id="Nombre"  name="Nombre" placeholder="Su nombre">
                        <br>
                        <label for="Apuesta">Apuesta: </label>
                        <input type="text" id="Apuesta" name="Apuesta" placeholder="$ Valor de tu apuesta" min="0">
                        <br>
                        <label for="Caballo">Id:  </label>
                        <input type="text" id="Caballo" name="Caballo" placeholder="Id Caballo" min="0">
                        <br>
                        <br>
                        <input type="submit" value="Guardar" id="submit">
                    </fieldset>
                </form>
                <div class="Better">
                    <div class="tabla">
                        
                    </div>
                </div>
                
            </div>
        </div>
        <div class="">
            
        </div>
    </body>
</html>
