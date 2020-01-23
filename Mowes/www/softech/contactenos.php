<?php
include ("Includes/header.php");
?>
<div align="center" id="contactenos">
<form action="Controlador/" method="post" id="contactenos">
<input name="solicitud" type="hidden" id="solicitud" value="contactenos" />
 <table width="300">
  <tr>
    <td colspan="2">Asegúrese de completar la información de todos los campos con informacíón verídica</td>
    </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
   <td>Nombre
   </td>
   <td><input name="nombre" type="text" class="cajaTexto" id="nombre" />
   </td>
  </tr>
  <tr>
   <td>E-mail
   </td>
   <td><input name="correo" type="text" class="cajaTexto" id="correo"  />
   </td>
  </tr>
  <tr>
    <td>Teléfono</td>
    <td><input name="telefono" type="text" class="cajaTexto" id="telefono"  />
      </td>
  </tr>
  <tr>
    <td colspan="2">Mensaje
     </td>
  </tr>
  <tr>
   <td colspan="2"><textarea name="mensaje" class="mensaje" id="mensaje"></textarea>
      </td>
   </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="Enviar" type="submit" class="botonEnviar
    " value=" "/></td>
    </tr>
 </table>
 </form>
</div>
<?php
include ("Includes/footer.php");
?>