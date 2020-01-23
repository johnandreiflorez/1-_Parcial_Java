<?
 class Usuario{

        var $nomUsuario="";
        var $contrasena="";

        function Usuario($nomUsuario,$contrasena){
	    $this->nomUsuario= $nomUsuario;
        $this->contrasena = $contrasena;	
        }

/*    function Usuario() {
        $this.nomUsuario = "";
        $this.contrasena = "";
    }
*/

    function getContrasena() {
        return $this->contrasena;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function getNomUsuario() {
        return $this->nomUsuario;
    }

    function setNomUsuario($nomUsuario) {
        $this->nomUsuario = $nomUsuario;
    }
}
    
?>