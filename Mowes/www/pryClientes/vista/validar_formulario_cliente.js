function validar_formulario_cliente(){

if (document.frmClientes.txtNombre.value.length==0){
alert("Debe ingresar su nombre")
document.frmClientes.txtNombre.focus()
return 0;
}


edad = document.form1.edad.value
edad = validarEntero(edad)
document.form1.edad.value=edad
if (edad==""){
alert("Debe ingresar su edad")
document.form1.edad.focus()
return 0;
}else{
if (edad<18){
alert(“Debe ser mayor de 18?)
document.form1.edad.focus()
return 0;
}
}


if (document.form1.motivo.selectedIndex==0){
alert("Debe seleccionar un motivo de su contacto")
document.form1.interes.focus()
return 0;
}


alert("Los datos fueron ingresados correctamente y seran enviados");
document.frmClientes.submit();
}
function validarEntero(valor){

valor = parseInt(valor)


if (isNaN(valor)) {

return ""
}else{
return valor
}
}
