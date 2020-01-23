<?
 class Viaje{

	var $idRuta="";
	var $TipVehiculo=0;
	var $IdVehiculo="";
	var $Fecha = "";
	var $Hora = "";
	
	function Viaje($idRuta, $TipVehiculo, $IdVehiculo, $Fecha, $Hora){
	$this->idRuta= $idRuta;
	$this->TipVehiculo = $TipVehiculo;
	$this->IdVehiculo = $IdVehiculo;		
	$this->Fecha = $Fecha;		
	$this->Hora = $Hora;		
	}

    function getidRuta() {
        return $this->idRuta;
    }

    function setidRuta($idRuta) {
        $this->idRuta = $idRuta;
    }

    function getTipVehiculo() {
        return $this->TipVehiculo;
    }

    function setTipVehiculo($TipVehiculo) {
        $this->TipVehiculo= $TipVehiculo;
    }
	
	 function getIdVehiculo() {
        return $this->IdVehiculo;
    }

    function setIdVehiculo($IdVehiculo) {
        $this->IdVehiculo = $IdVehiculo;
    }
	 function getFecha() {
        return $this->Fecha;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }
	
	 function getHora() {
        return $this->Hora;
    }

    function setHora($Hora) {
        $this->Hora = $Hora;
    }
}
?>