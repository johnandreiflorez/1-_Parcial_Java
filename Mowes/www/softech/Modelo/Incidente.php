<?
  class Incidente{

        var $COD_INCID="";
        var $DESC_INCID="";
        var $FECHAREGIS_INCID="";
        var $FECHASOLUC_INCID="";
        var $FKUSUARIO="";
        var $FKPRIORIDAD="";
        var $FKESTADO="";
        var $FKCATEGORIA="";
        var $FKRESPONSABLE="";


        function Incidente($COD_INCID,$DESC_INCID,$FECHAREGIS_INCID,$FECHASOLUC_INCID,$FKUSUARIO,$FKPRIORIDAD,$FKESTADO,$FKCATEGORIA,$FKRESPONSABLE)
         {
	    $this->COD_INCID= $COD_INCID;
        $this->DESC_INCID = $DESC_INCID;
        $this->FECHAREGIS_INCID= $FECHAREGIS_INCID;
        $this->FECHASOLUC_INCID = $FECHASOLUC_INCID;
        $this->FKUSUARIO= $FKUSUARIO;
        $this->FKPRIORIDAD = $FKPRIORIDAD;
        $this->FKESTADO= $FKESTADO;
        $this->FKCATEGORIA = $FKCATEGORIA;
        $this->FKRESPONSABLE= $FKRESPONSABLE;
        }

      function SetCOD_INCID($COD_INCID){
  		$this->COD_INCID= $COD_INCID;
      }
      function GetCOD_INCID(){
		return   $this->COD_INCID;
      }
      function SetDESC_INCID($DESC_INCID){
  		$this->DESC_INCID= $DESC_INCID;
      }
      function GetDESC_INCID(){
	   return	$this->DESC_INCID;
      }
      function SetFECHAREGIS_INCID($FECHAREGIS_INCID){
  		$this->FECHAREGIS_INCID= $FECHAREGIS_INCID;
      }
      function GetFECHAREGIS_INCID(){
	   return	$this->FECHAREGIS_INCID;
      }
      function SetFECHASOLUC_INCID($FECHASOLUC_INCID){
  		$this->FECHASOLUC_INCID= $FECHASOLUC_INCID;
      }
      function GetFECHASOLUC_INCID(){
		return   $this->FECHASOLUC_INCID;
      }
      function SetFKUSUARIO($FKUSUARIO){
  		$this->FKUSUARIO= $FKUSUARIO;
      }
      function GetFKUSUARIO(){
		return   $this->FKUSUARIO;
      }
      function SetFKPRIORIDAD($FKPRIORIDAD){
  		$this->FKPRIORIDAD= $FKPRIORIDAD;
      }
      function GetFKPRIORIDAD(){
		return   $this->FKPRIORIDAD;
      }
      function SetFKESTADO($FKESTADO){
  		$this->FKESTADO= $FKESTADO;
      }
      function GetFKESTADO(){
		return   $this->FKESTADO;
      }
      function SetFKCATEGORIA($FKCATEGORIA){
  		$this->FKCATEGORIA= $FKCATEGORIA;
      }
      function GetFKCATEGORIA(){
		return   $this->FKCATEGORIA;
      }
      function SetFKRESPONSABLE($FKRESPONSABLE){
  		$this->FKRESPONSABLE= $FKRESPONSABLE;
      }
      function GetFKRESPONSABLE(){
		return   $this->FKRESPONSABLE;
      }

}

?>



