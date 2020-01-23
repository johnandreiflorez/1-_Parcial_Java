<?
 session_start();
 //$_SESSION=array();
 //session_destroy();
   //phpinfo();
   if(isset($_SESSION['Usu'])){
 echo "Usuario=".$_SESSION['Usu'];
 echo "Contraseña". $_SESSION['Con'];


 echo "
 <html>
  <head>
    <title></title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
  </head>
  <body>
      <center>
      <h1>MENÚ PRINCIPAL</h1>
         <table>
            <tr>
                <td><A href=\"VUsuarios.php\">Usuarios </A></td><td><A href=\"VUsuarios.php\">Usuarios </A></td><td><A href=\"VUsuarios.php\">Usuarios </A></td>
            </tr>
        </table>
    </center>

 <form>
<select onchange = \"fecha.style.visibility = (this.selectedIndex==0) ? 'hidden' : 'visible'\">
<option>UNO</option>
<option>DOS</option>
</select>
<input type=\"text\" name=\"fecha\" style = \"visibility:hidden\" />
</form>
</body>
</html>";
 }
 session_destroy()
 ?>