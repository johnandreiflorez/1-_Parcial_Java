<?
class Area{
	    var $idarea=0;
        var $nombre="";
        var $fkemple="";

        function Area($idarea,$nombre,$fkemple){
        		
	    $this->idarea=    $idarea;
        $this->nombre=    $nombre;
        $this->fkemple=   $fkemple;
        	
        }
        function setIdarea($idarea){
         $this->idarea=    $idarea;
        }
        function getIdarea(){
		return  $this->idarea;
        }
        function setNombre($nombre){
         $this->nombre=    $nombre;
        }
        function getNombre(){
		return  $this->nombre;
        }
        function setFkEmple($fkEmple){
         $this-> fkemple=    $fkEmple;
        }
        function getFkEmple(){
		return  $this->fkemple;
        }

}
?>