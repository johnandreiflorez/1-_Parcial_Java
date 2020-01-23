<?
  class Usuario{

        var $ID_USER="";
        var $NOMB_USER="";
        var $APELL_USER="";
        var $EMAIL_USER="";
        var $TEL_USER="";
        var $CEL_USER="";
        var $DIR_USER="";
        var $COUNTUSER_USER="";
        var $PASSWORD_USER="";
        var $FKCIUDAD="";
        var $FOTO_USER="";

        function Usuario($ID_USER,$NOMB_USER,$APELL_USER,$EMAIL_USER,$TEL_USER,$CEL_USER,$DIR_USER,$COUNTUSER_USER,$PASSWORD_USER,$FKCIUDAD,$FOTO_USER)
         {
	    $this->ID_USER= $ID_USER;
        $this->NOMB_USER = $NOMB_USER;
        $this->APELL_USER= $APELL_USER;
        $this->EMAIL_USER = $EMAIL_USER;
        $this->TEL_USER= $TEL_USER;
        $this->CEL_USER = $CEL_USER;
        $this->DIR_USER= $DIR_USER;
        $this->COUNTUSER_USER = $COUNTUSER_USER;
        $this->PASSWORD_USER= $PASSWORD_USER;
        $this->FKCIUDAD = $FKCIUDAD;
        $this->FOTO_USER = $FOTO_USER;
        }

      function SetID_USER($ID_USER){
  		$this->ID_USER= $ID_USER;
      }
      function GetID_USER(){
		return   $this->ID_USER;
      }
      function SetNOMB_USER($NOMB_USER){
  		$this->NOMB_USER= $NOMB_USER;
      }
      function GetNOMB_USER(){
	   return	$this->NOMB_USER;
      }
      function SetAPELL_USER($APELL_USER){
  		$this->APELL_USER= $APELL_USER;
      }
      function GetAPELL_USER(){
	   return	$this->APELL_USER;
      }
      function SetEMAIL_USER($EMAIL_USER){
  		$this->EMAIL_USER= $EMAIL_USER;
      }
      function GetEMAIL_USER(){
		return   $this->EMAIL_USER;
      }
      function SetTEL_USER($TEL_USER){
  		$this->TEL_USER= $TEL_USER;
      }
      function GetTEL_USER(){
		return   $this->TEL_USER;
      }
      function SetCEL_USER($CEL_USER){
  		$this->CEL_USER= $CEL_USER;
      }
      function GetCEL_USER(){
		return   $this->CEL_USER;
      }
      function SetDIR_USER($DIR_USER){
  		$this->DIR_USER= $DIR_USER;
      }
      function GetDIR_USER(){
		return   $this->DIR_USER;
      }
      function SetCOUNTUSER_USER($COUNTUSER_USER){
  		$this->COUNTUSER_USER= $COUNTUSER_USER;
      }
      function GetCOUNTUSER_USER(){
		return   $this->COUNTUSER_USER;
      }
      function SetPASSWORD_USER($PASSWORD_USER){
  		$this->PASSWORD_USER= $PASSWORD_USER;
      }
      function GetPASSWORD_USER(){
		return   $this->PASSWORD_USER;
      }
      function SetFKCIUDAD($FKCIUDAD){
  		$this->FKCIUDAD= $FKCIUDAD;
      }
      function GetFKCIUDAD(){
		return   $this->FKCIUDAD;
      }
      function SetFOTO_USER($FOTO_USER){
  		$this->FOTO_USER= $FOTO_USER;
      }
     function GetFOTO_USER(){
		return   $this->FOTO_USER;
      }
    
}

?>



