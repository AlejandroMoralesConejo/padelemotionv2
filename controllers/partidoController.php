<?php

require_once "models/Partido.php";
require_once "models/Jugador.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";

class partidoController extends BaseController
{
    private $error = false;
    private $error2 = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {

        $limite = $_GET["limite"];
        $idPartido = $_GET["idPartido"];
        $idJugador = $_GET["idJugador"];

        if ($limite < 4)
        {
            Partido::anadirJugador($idPartido, $idJugador);
            header("location: index.php?idPart=$idPartido&idJuga=$idJugador");
        }
        
    }

    public function mostrar()
    {
        $idPartido = $_GET["id"];
        $partido = Partido::find($idPartido);
        $jugadores = Partido::findJugadores($idPartido);
        echo $this->twig->render("showPartido.php.twig", (['partido' => $partido, 'jugadores' => $jugadores]));
    }

}