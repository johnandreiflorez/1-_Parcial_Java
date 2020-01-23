<?
 class Cliente{

        var $nomCliente="";
        var $idCliente="";
        var $dirCliente="";
        var $telCliente;
        var $sexoCliente="";
        var $fechaCliente="";
        var $afcDep= false;
        var $afcLit= false;
        var $afcTec= false;
        var $afcMus= false;
        var $afcCin= false;
        var $afcOtr= false;
        var $afcCual= "";
        var $doc= "";
        var $observ="";
        var $fotoCliente="";

        function Cliente($nomCliente,$idCliente,$dirCliente,$telCliente,$sexoCliente,$fechaCliente,
        $afcDep,$afcLit,$afcTec,$afcMus,$afcCin,$afcOtr,$afcOtr,$afcCual,$doc,$observ,$fotoCliente){
	    $this->nomCliente= $nomCliente;
        $this->idCliente = $idCliente;
        $this->dirCliente=$dirCliente;
        $this->telCliente=$telCliente;
        $this->sexoCliente=$sexoCliente;
        $this->fechaCliente=$fechaCliente;
        $this->afcDep=$afcDep;
        $this->afcLit=$afcLit;
        $this->afcTec=$afcTec;
        $this->afcMus=$afcMus;
        $this->afcCin=$afcCin;
        $this->afcOtr=$afcOtr;
        $this->afcCual=$afcCual;
        $this->doc= $doc;
        $this->observ=$observ;
        $this->fotoCliente=$fotoCliente;
        }

      function getIdCliente(){
		return   $this->idCliente;
      }
      function setNomCliente($nomCliente){
  		$this->nomCliente= $nomCliente;
      }
      function getNomCliente(){
	   return	$this->nomCliente;
      }
      function setFotoCliente($fotoCliente){
  		$this->fotoCliente= $fotoCliente;
      }
      function getFotoCliente(){
	   return	$this->fotoCliente;
      }
}
    
?>