<?
 class Cliente{

        var $identificacion="";
        var $nombre="";
		var $telefono="";

        function Cliente($identificacion, $nombre, $telefono){
	    $this->identificacion= $identificacion;
        $this->nombre = $nombre;	
		$this->telefono=$telefono;
        }

    function getIdentificacion() {
        return $this->identificacion;
    }

    function setIdentificacion($identificacion) {
        $this->identificacion = $identificacion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
	
	function getTelefono() {
        return $this->telefono;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
}
?>