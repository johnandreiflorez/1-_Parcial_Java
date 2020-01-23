<?
class Ruta
{
    var $id_ruta="";
    var $descripcion="";

    function Ruta($id_ruta,$descripcion)
    {
		$this->id_ruta=$id_ruta;
        $this->descripcion=$descripcion;
    }


    function getId_Ruta()
    {
		return $this->id_ruta;
    }

    function setId_Ruta($id_ruta)
    {
        $this-> id_ruta = $id_ruta;
    }


    function getDescripcion()
    {
		return $this->descripcion;
    }

    function setDescripcion($descripcion)
    {
		$this-> descripcion = $descripcion;
    }
}
?>