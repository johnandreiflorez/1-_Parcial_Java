<?
  class Responsable{

        var $ID_RESP="";
        var $NOMB_RESP="";
        var $APELL_RESP="";
        var $EMAIL_RESP="";
        var $TEL_RESP="";
        var $CEL_RESP="";
        var $CARGO_RESP="";
        var $COUNTUSER_RESP="";
        var $PASSWORD_RESP="";
        var $FOTO_RESP="";

        function Responsable($ID_RESP,$NOMB_RESP,$APELL_RESP,$EMAIL_RESP,$TEL_RESP,$CEL_RESP,$CARGO_RESP,$COUNTUSER_RESP,$PASSWORD_RESP,$FOTO_RESP)
         {
	    $this->ID_RESP= $ID_RESP;
        $this->NOMB_RESP = $NOMB_RESP;
        $this->APELL_RESP= $APELL_RESP;
        $this->EMAIL_RESP = $EMAIL_RESP;
        $this->TEL_RESP= $TEL_RESP;
        $this->CEL_RESP = $CEL_RESP;
        $this->CARGO_RESP= $CARGO_RESP;
        $this->COUNTUSER_RESP = $COUNTUSER_RESP;
        $this->PASSWORD_RESP= $PASSWORD_RESP;
        $this->FOTO_RESP = $FOTO_RESP;
        echo "pass ". $PASSWORD_RESP;
        }

      function SetID_RESP($ID_RESP){
  		$this->ID_RESP= $ID_RESP;
      }
      function GetID_RESP(){
		return   $this->ID_RESP;
      }
      function SetNOMB_RESP($NOMB_RESP){
  		$this->NOMB_RESP= $NOMB_RESP;
      }
      function GetNOMB_RESP(){
	   return	$this->NOMB_RESP;
      }
      function SetAPELL_RESP($APELL_RESP){
  		$this->APELL_RESP= $APELL_RESP;
      }
      function GetAPELL_RESP(){
	   return	$this->APELL_RESP;
      }
      function SetEMAIL_RESP($EMAIL_RESP){
  		$this->EMAIL_RESP= $EMAIL_RESP;
      }
      function GetEMAIL_RESP(){
		return   $this->EMAIL_RESP;
      }
      function SetTEL_RESP($TEL_RESP){
  		$this->TEL_RESP= $TEL_RESP;
      }
      function GetTEL_RESP(){
		return   $this->TEL_RESP;
      }
      function SetCEL_RESP($CEL_RESP){
  		$this->CEL_RESP= $CEL_RESP;
      }
      function GetCEL_RESP(){
		return   $this->CEL_RESP;
      }
      function SetCARGO_RESP($CARGO_RESP){
  		$this->CARGO_RESP= $CARGO_RESP;
      }
      function GetCARGO_RESP(){
		return   $this->CARGO_RESP;
      }
      function SetCOUNTUSER_RESP($COUNTUSER_RESP){
  		$this->COUNTUSER_RESP= $COUNTUSER_RESP;
      }
      function GetCOUNTUSER_RESP(){
		return   $this->COUNTUSER_RESP;
      }
      function SetPASSWORD_RESP($PASSWORD_RESP){
  		$this->PASSWORD_RESP= $PASSWORD_RESP;
      }
      function GetPASSWORD_RESP(){
		return   $this->PASSWORD_RESP;
      }
      function SetFOTO_RESP($FOTO_RESP){
  		$this->FOTO_RESP= $FOTO_RESP;
      }
     function GetFOTO_RESP(){
		return   $this->FOTO_RESP;
      }
    
}

?>



