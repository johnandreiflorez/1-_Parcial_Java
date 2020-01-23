<?php
  class Detalle{
    var $id;
    var $dato;
    var $idmaestro;
  public function Detalle($dato,$idmaestro){
  $this->dato= $dato;
  $this->idmaestro=$idmaestro;
  }

  public function getId(){
		return $this->id;
  }
  public function getDato(){
		return $this->dato;
  }
    public function setDato($dato){
		 $this->dato=$dato;
  }
  public function getIdmaestro(){
		return $this->idmaestro;
  }
    public function setIdmaestro($idmaestro){
		 $this->idmaestro=$idmaestro;
  }
  }


?>