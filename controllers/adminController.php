<?php

    require_once "BaseController.php";
    require_once "models/Pista.php";
    require_once "models/Partido.php";

    class adminController extends BaseController
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function add()
        {
            if (empty($_GET["nombre"]))
            {
                $data = Pista::findAll();
                echo $this->twig->render("addPartido.php.twig", ['data' => $data]);
            } else {
                $nombre = $_GET["nombre"];
                $fecha = $_GET["fecha"];
                $hora = $_GET["hora"];
                $idPista = $_GET["idPista"];

                $partido = new Partido();
                $partido->setNombre($nombre);
                $partido->setFecha($fecha);
                $partido->setHora($hora);
                $partido->setIdPista($idPista);

                $partido->guardar();

                header("location: index.php");
            }
        }

        public function edit()
        {
            $data = Partido::find($_GET["id"]);
            $pista = Pista::findAll();

            if (empty($_GET["nombre"]))
            {
                echo $this->twig->render("editPartido.php.twig", (['data' => $data, 'pista' => $pista]));
            } else {
                $nombre = $_GET["nombre"];
                $fecha = $_GET["fecha"];
                $hora = $_GET["hora"];
                $idPista = $_GET["idPista"];

                $data->setNombre($nombre);
                $data->setFecha($fecha);
                $data->setHora($hora);
                $data->setIdPista($idPista);

                $data->guardar();

                header("location: index.php");
            }
        }

        public function delete()
        {
            $id = $_GET["id"];
            $partido = Partido::find($id);
            $partido->delete();

            header("location: index.php");

        }
    }