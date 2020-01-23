<?
 class Vehiculo{

	var $idVehiculo="";
	var $Descripcion="";
	var $idTipVehiculo="";
	
	function Vehiculo($idVehiculo, $Descripcion, $idTipVehiculo){
	$this->idVehiculo= $idVehiculo;
	$this->Descripcion = $Descripcion;
	$this->idTipVehiculo = $idTipVehiculo;		
	}

    function getidTipVehiculo() {
        return $this->idTipVehiculo;
    }

    function setidTipVehiculo($idTipVehiculo) {
        $this->idTipVehiculo = $idTipVehiculo;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
	
	 function getidVehiculo() {
        return $this->idVehiculo;
    }

    function setidVehiculo($idTipVehiculo) {
        $this->idVehiculo = $idTipVehiculo;
    }
}
?>