<?php

class   Vivienda {
 var $idVivienda;
 var $direcion;
 var $telefono;
 var $tipo;
 var $fkCliente;

 function  Vivienda($idVivienda,$direcion,$telefono,$tipo,$fkCliente){
  $this->idVivienda= $idVivienda;
  $this->direcion= $direcion;
  $this->telefono= $telefono;
  $this->tipo= $tipo;
  $this->fkCliente= $fkCliente;
 }

 function  getIdVivienda(){
		return   $this->idVivienda;
 }
 function  setIdVivienda($idVivienda){
		$this->idVivienda= $idVivienda;
 }


 function  getDirecion(){
		return   $this->direcion;
 }
 function  setDirecion($direcion){
		$this->direcion= $direcion;
 }


 function  getTelefono(){
		return   $this->telefono;
 }
 function  setTelefono($telefono){
		$this->telefono= $telefono;
 }

  function  getTipo(){
		return   $this->tipo;
 }
 function  setTipo($tipo){
		$this->tipo= $tipo;
 }

  function  getFkCliente(){
		return   $this->fkCliente;
 }
 function  setFkCliente($fkCliente){
		$this->fkCliente= $fkCliente;
 }
}

?>