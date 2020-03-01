<?php
require_once "libs/Database.php";

class Jugador
{
	private $idJug;
	private $email;
	private $pass;
	private $nombreJ;
	private $fec_nacimiento;
	private $posicion;
	private $foto;
	private $perfil;
	private $api_key;

	public function __construct()
	{
	}

	//id
	public function getIdJug():int
	{
		return $this->idJug;
	}


	public function setIdJug($idJug)
	{
		$this->idJug = $idJug;

		return $this;
	}

	//email
	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	public function getPass()
	{
		return $this->pass;
	}

	public function setPass($pass)
	{
		$this->pass = $pass;

		return $this;
	}

	//nombre
	public function getNombreJ()
	{
		return $this->nombreJ;
	}

	public function setNombreJ($nombreJ)
	{
		$this->nombreJ = $nombreJ;

		return $this;
	}

	//fecha de nacimiento
	public function getFecNacimiento()
	{
		return $this->fec_nacimiento;
	}

	public function setFecNacimiento($fec_nacimiento)
	{
		$this->fec_nacimiento = $fec_nacimiento;

		return $this;
	}


	//posicion
	public function getPosicion()
	{
		return $this->posicion;
	}

	public function setPosicion($posicion)
	{
		$this->posicion = $posicion;

		return $this;
	}

	//posicion
	public function getFoto()
	{
		return $this->foto;
	}

	public function setFoto($foto)
	{
		$this->foto = $foto;

		return $this;
	}

	//perfil
	public function getPerfil()
	{
		return $this->perfil;
	}

	public function setPerfil($perfil)
	{
		$this->perfil = $perfil;

		return $this;
	}

	//api key
	public function getApiKey()
	{
		return $this->api_key;
	}

	public function setApiKey($key)
	{
		$this->api_key = $key;

		return $this;
	}



	// public function __toString()
	// {
	// 	return $this->nombre;
	// }


	public static function find($id)
	{
		$db = Database::getInstance();
		$db->query("SELECT idJug, email, nombreJ, DATE_FORMAT(fec_nacimiento,'%Y-%m-%d') as fec_nacimientos, posicion, foto, perfil FROM jugador WHERE idJug = $id");
		return $db->getObject("Jugador");
	}

	public function guardar()
	{
		$db = Database::getInstance();

		if (is_null($this->idJug))
		{
			// insert
			$db->query("INSERT INTO jugador (email, pass, nombreJ, fec_nacimiento, posicion)
            VALUES ('{$this->email}',MD5($this->pass),'{$this->nombreJ}','{$this->fec_nacimiento}',
			'{$this->posicion}');");
			$this->idJug = $db->lastId();
		} else {
			// update
			$db->query("UPDATE jugador SET email='{$this->email}', nombreJ='{$this->nombreJ}',
			 fec_nacimiento='{$this->fec_nacimiento}', posicion='{$this->posicion}' 
			WHERE idJug={$this->idJug};");
		}
	}

	public static function delete($id)
    {
        $db = Database::getInstance();

        //borrado
        $db->query("DELETE FROM jugador WHERE idJug=$id");
	}

	public static function buscarPass($pass)
	{
		$db = Database::getInstance();
		$db->query("SELECT pass FROM jugador WHERE idJug=$pass");
		return $db->getObject("Jugador")->getPass();
	}
	
}
