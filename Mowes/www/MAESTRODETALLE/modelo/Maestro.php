<?php
  class Maestro{
		var $idmaestro;
        var $nombre;
   public function Maestro($idmaestro,$nombre){
    $this->idmaestro= $idmaestro;
    $this->nombre= $nombre;
   }
   public function getIdMaestro(){
	return	$this->idmaestro;
   }
   public function setIdMaestro($idmaestro){
    $this->idmaestro= $idmaestro;
    }
   public function getNombre(){
	return	$this->nombre;
   }
   public function setNombre($nombre){
    $this->nombre= $nombre;
    }
  }


?>