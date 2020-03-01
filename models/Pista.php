<?php


	class Pista
	{
		private $idPista;
		private $nombre;
		private $direccion;

		public function __construct() { }

        //id pista
	    public function getIdPista()
	    {
	        return $this->idPista;
	    }


	    public function setIdPista($idPista)
	    {
	        $this->idPista = $idPista;

	        return $this;
	    }

        //nombre
	    public function getNombre()
	    {
	        return $this->nombre;
	    }

	    public function setNombre($nombre)
	    {
	        $this->nombre = $nombre;

	        return $this;
	    }

        //direccion de la pista
	    public function getDireccion()
	    {
	        return $this->direccion;
	    }

	    public function setDireccion($direccion)
	    {
	        $this->direccion = $direccion;

	        return $this;
	    }


	    public function __toString()
	    {
	    	return $this->nombre;
		}
		
		public static function find($id)
		{
			$sql = "SELECT nombre, direccion FROM pista WHERE idPista=$id;";
			$db = Database::getInstance();
			$db->query($sql);
	
			return $db->getObject("Pista");
		}

		public static function findAll()
		{
			$sql = "SELECT * FROM pista;";
			$db = Database::getInstance();
			$db->query($sql);
			$listado = [];
			while ($pista = $db->getObject("Pista"))
				array_push($listado, $pista);
	
			return $listado;
		}
	}