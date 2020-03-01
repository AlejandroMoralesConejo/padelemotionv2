<?php

require_once "models/Jugador.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";

class jugadorController extends BaseController
{
    private $error = false;
    private $error2 = false;

    public function __construct()
    {
        parent::__construct();
    }

    public function edit()
    {
        // buscamos al usuario logueado
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        // var_dump($id);
        $dat = Jugador::find($id);

        if (!isset($_POST["emailEdit"]))
        {
            // mostramos el perfil con posibilidad de actualizarlo
            // var_dump($dat);
            echo $this->twig->render("showProfile.php.twig", (['dat' => $dat, 'error' => "nada"]));
        } else {
            // si está seteado recogemos los valores para hacer el update
            $ema = $_POST["emailEdit"];
            // $pas = $_POST["passEdit"];
            $nom = $_POST["nombreEdit"];
            $fec = !empty($_POST["fnacEdit"]) ? $_POST["fnacEdit"] : null;
            $pos = $_POST["posicionEdit"];
            // $con = $_POST["confEdit"];

            // if ($pas == $dat->getPass())
            // {
                // actualizar los datos
            $dat->setEmail($ema);
            $dat->setNombreJ($nom);
            $dat->setPosicion($pos);
            $dat->setFecNacimiento($fec);

            //update en la bd
            $dat->guardar();
            $this->error2 = true;
                
            // } else {
            //     $this->error2 = true;
            // }
            // $dat = Jugador::find($sesion->getUsuario());
            echo $this->twig->render("showProfile.php.twig", (['dat' => $dat, 'error' => $this->error2]));
        }
    }

    public function register()
    {
        if (!isset($_POST["email"])) {
            echo $this->twig->render("showRegistro.php.twig", ['error' => $this->error]);
        } else {
            // capturamos los datos del formulario
            $ema = $_POST["email"];
            $pas = $_POST["pass"];
            $nom = $_POST["nombre"];
            $fec = !empty($_POST["fnac"]) ? $_POST["fnac"] : null;
            $pos = $_POST["posicion"];
            $con = $_POST["conf"];

            // si las contraseñas coinciden
            if ($pas == $con) {
                $jugador = new Jugador();
                //set del objeto
                $jugador->setEmail($ema);
                $jugador->setPass($pas);
                $jugador->setNombreJ($nom);
                $jugador->setFecNacimiento($fec);
                $jugador->setPosicion($pos);
                // guardamos en la bd
                $jugador->guardar();
            } else {
                $this->error = "Las contraseñas no coinciden";
                echo $this->twig->render("showRegistro.php.twig", ['error' => $this->error]);
            }
            $sesion = Sesion::getInstance();
            if ($sesion->login($ema, $pas)) {
                $id = $sesion->getUsuario();
                header("location:?con=login&ope=goMain&id=$id");
            }
        }
    }

    /**
     * Borrar usuario
     */
    public function borrar()
    {
        if (isset($_GET["idJugador"]))
        {
            $id = $_GET["idJugador"];
            Jugador::delete($id);
            Sesion::getInstance()->close();
            header("location: index.php");

        }
    }
}
