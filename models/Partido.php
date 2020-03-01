<?php

require_once "libs/Database.php";
require_once "Jugador.php";

class Partido
{
	private $idPartido;
	private $nombre;
	private $fecha;
	private $hora;
	private $limite;
	private $idPista;

	public function __construct()
	{
	}

	//id
	public function getIdPartido()
	{
		return $this->idPartido;
	}


	public function setIdPartido($idPartido)
	{
		$this->idPartido = $idPartido;

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

	//fecha del torneo
	public function getFecha()
	{
		return $this->fecha;
	}

	public function setFecha($fecha)
	{
		$this->fecha = $fecha;

		return $this;
	}


	//hora
	public function getHora()
	{
		return $this->hora;
	}

	public function setHora($hora)
	{
		$this->hora = $hora;

		return $this;
	}

	//limite de jugadores (4)
	public function getLimite()
	{
		return $this->limite;
	}

	public function setLimite($limite)
	{
		$this->limite = $limite;

		return $this;
	}

	//pista
	public function getIdPista()
	{
		return $this->idPista;
	}

	public function setIdPista($idPista)
	{
		$this->idPista = $idPista;

		return $this;
	}



	public function __toString()
	{
		return $this->nombre;
	}

	public static function find($id)
	{
		$sql = "SELECT idPartido, nombre, fecha, DATE_FORMAT(fecha,'%d/%m/%Y') as fechaOrdenada, DAYNAME(fecha) as dia,
		 hora, idPista FROM partido WHERE idPartido=$id;";
		$db = Database::getInstance();
		$db->query($sql);
		return $db->getObject("Partido");
	}

	public static function findAll()
	{
		$sql = "SELECT * FROM (SELECT p.idPartido, p.nombre, p.fecha as fechaOrden, DATE_FORMAT(p.fecha,'%d/%m/%Y') as fecha, DAYNAME(p.fecha) as dia,
		 TIME_FORMAT(p.hora,'%H:%i') as hora, p.limite, x.nombreP, x.direccionP FROM partido p JOIN pista x ON p.idPista = x.idPista)
		  T1 LEFT JOIN (SELECT COUNT(*) as jugadores, partido_jugador.idPartido as partidazo FROM jugador, partido_jugador WHERE
		   jugador.idJug = partido_jugador.idJug) T2 ON T1.idPartido=T2.partidazo ORDER BY fechaOrden, hora";

		$db = Database::getInstance();
		$db->query($sql);
		$listado = [];
		while ($partido = $db->getObject("Partido"))
			array_push($listado, $partido);

		return $listado;

	}

	public static function anadirJugador($idPartido, $idJugador)
	{
		$db = Database::getInstance();
		// Si se inserta, actualizamos update
		$stm = $db->insert("INSERT INTO partido_jugador (idPartido, idJug) VALUES ($idPartido, $idJugador);");
		if ($stm->rowCount() > 0)
		{
			$db->query("UPDATE partido SET limite = limite + 1 WHERE idPartido = $idPartido;");
		}
			
	}

	public function guardar()
	{
		$db = Database::getInstance();

		if (is_null($this->idPartido))
		{
			// insert
			$db->query("INSERT INTO partido (nombre, fecha, hora, idPista)
            VALUES ('{$this->nombre}', '{$this->fecha}','{$this->hora}', {$this->idPista});");
			$this->idPartido = $db->lastId();
		} else {
			// update
			$db->query("UPDATE partido SET nombre='{$this->nombre}', fecha='{$this->fecha}',
			 hora='{$this->hora}', idPista={$this->idPista} WHERE idPartido={$this->idPartido};");
		}
	}

	public function delete()
	{
		$db = Database::getInstance();
		$db->query("DELETE FROM partido WHERE idPartido=$this->idPartido");
	}

	public static function findJugadores($id)
	{
		$db = Database::getInstance();
		$sql = "SELECT j.nombreJ, j.posicion, j.foto FROM jugador j, partido_jugador x WHERE x.idPartido=$id AND j.idJug=x.idJug;";
		$db->query($sql);
		$listado = [];
		while ($jugador = $db->getObject("Jugador"))
			array_push($listado, $jugador);

		return $listado;
	}
}

	
