<?
 class Reserva{
	var $Id_Viaje ;
	var $Id_Cliente ;
	var $Cantidad ;
	var $Id_Estado;
	var $Id_RUT_VIAJ;
	var $Fecha_VIAJ;
	var $Id_VEH_VIAJ;
	
	function Reserva($Id_Viaje, $Id_Cliente, $Cantidad, $Id_Estado,$Id_RUT_VIAJ,$Fecha_VIAJ,$Id_VEH_VIAJ){
	$this->Id_Viaje= $Id_Viaje;
	$this->Id_Cliente = $Id_Cliente;
	$this->Cantidad = $Cantidad;		
	$this->Id_Estado = $Id_Estado;
	$this->Id_RUT_VIAJ = $Id_RUT_VIAJ;
	$this->Fecha_VIAJ = $Fecha_VIAJ;		
	$this->Id_VEH_VIAJ = $Id_VEH_VIAJ;		
	}

    function getId_Viaje() {
        return $this->Id_Viaje;
    }

    function setId_Viaje($Id_Viaje) {
        $this->Id_Viaje = $Id_Viaje;
    }

    function getId_Cliente() {
        return $this->Id_Cliente;
    }

    function setId_Cliente($Id_Cliente) {
        $this->Id_Cliente = $Id_Cliente;
    }
	
	 function getCantidad() {
        return $this->Cantidad;
    }

    function setCantidad($Cantidad) {
        $this->Cantidad = $Cantidad;
    }
	 function getId_Estado() {
        return $this->Id_Estado;
    }

    function setId_Estado($Id_Estado) {
        $this->Id_Estado = $Id_Estado;
    }
	
	 function getId_RUT_VIAJ() {
        return $this->Id_RUT_VIAJ;
    }

    function setId_RUT_VIAJ($Id_RUT_VIAJ) {
        $this->Id_RUT_VIAJ = $Id_RUT_VIAJ;
    }
	 function getFecha_VIAJ() {
        return $this->Fecha_VIAJ;
    }

    function setFecha_VIAJ($Fecha_VIAJ) {
        $this->Fecha_VIAJ = $Fecha_VIAJ;
    }
	
	function getId_VEH_VIAJ() {
        return $this->Id_VEH_VIAJ;
    }

    function setId_VEH_VIAJ($Id_VEH_VIAJ) {
        $this->Id_VEH_VIAJ = $Id_VEH_VIAJ;
    }
}
?>