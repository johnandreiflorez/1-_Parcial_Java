<?php
  class   Cliente {
 var $idCliente;
 var $nombre;
 var $celular;

 function  Cliente($idCliente,$nombre,$celular){
  $this->idCliente= $idCliente;
  $this->nombre= $nombre;
  $this->celular= $celular;
 }

 function  getIdCliente(){
		return   $this->idCliente;
 }
 function  setIdCliente($idCliente){
		$this->idCliente= $idCliente;
 }


 function  getNombre(){
		return   $this->nombre;
 }
 function  setNombre($nombre){
		$this->nombre= $nombre;
 }


 function  getCelular(){
		return   $this->celular;
 }
 function  setCelular($celular){
		$this->celular= $celular;
 }

}


?>