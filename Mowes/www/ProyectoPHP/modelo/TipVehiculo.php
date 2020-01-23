<?
 class TipVehiculo{

	var $Descripcion="";
	var $idTipVehiculo="";
	
	function TipVehiculo($idTipVehiculo, $Descripcion){
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
	
}
?>