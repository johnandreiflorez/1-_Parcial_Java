//Validacion de campos de texto no vacios by Mauricio Escobar
//
//Iván Nieto Pérez
//Este script y otros muchos pueden
//descarse on-line de forma gratuita
//en El Código: www.elcodigo.com


//*********************************************************************************
// Function que valida que un campo contenga un string y no solamente un " "
// Es tipico que al validar un string se diga
//    if(campo == "") ? alert(Error)
// Si el campo contiene " " entonces la validacion anterior no funciona
//*********************************************************************************

//busca caracteres que no sean espacio en blanco en una cadena

function vacio(q) {
        for ( i = 0; i < q.length; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}

//valida que el campo no este vacio y no tenga solo espacios en blanco
function valida(F) {

        if( vacio(F.campo.value) == false ) {
                alert("Introduzca un cadena de texto.")
                return false
        } else {
                alert("OK")
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario
                return false
        }

}
//Esta fución no estaba en el archivo de Iván Nieto Pérez
function mensaje(mesajeDeTexto){
		alert(mesajeDeTexto)
}



