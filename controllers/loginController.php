<?php

require_once "models/Partido.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Login.php";

class loginController extends BaseController
{
    private $error = false;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Si la sesion existe: mandamos al main
     * Si no: mostramos el login
     */
    public function show()
    {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession())
        {
            $usuario = Jugador::find($sesion->getUsuario());
            $esAdmin = $usuario->getPerfil();
            if ($esAdmin) {
                $this->goMainAdmin();
            } else {
                $this->goMain($sesion->getUsuario());
            }
        } else {
            echo $this->twig->render("showLogin.php.twig", ['error' => $this->error]);
        }
    }

    public function signin()
    {
        if (isset($_POST['email'])) {
            $ses = Sesion::getInstance();
            // $idUsu = $ses->getUsuario()??0;
            // if ($ses->checkActiveSession()) $this->goMain($ses);

            //login con email y contraseña
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

            //comprobamos si es admin
            $existe = $ses->login($email, $pass);
            if ($existe)
            {
                $idUsu = $ses->getUsuario();
                $usuario = Jugador::find($idUsu);
            }
            // si el usuario existe redigirimos al main
            if ($existe && ($usuario->getPerfil()==1)) {
                $this->goMainAdmin();
            } else if($existe) {
                $this->goMain($ses->getUsuario());
            } else {
                $this->error = true;
                echo $this->twig->render("showLogin.php.twig", ['error' => $this->error]);
            }
        }
    }

    public function goMain($id = null)
    {
        $idJugador = $_GET["id"]??$id;
        $data = Partido::findAll();
        $idPart = 0;
        if (isset($_GET["idPart"]))
        {
            // idPartido sirve para indicar que ya estamos apuntados a X partido
            $idPart = $_GET["idPart"];
        }
        echo $this->twig->render("showMain.php.twig", (['data' => $data, 'idJugador' => $idJugador, 'idPart' => $idPart]));
    }

    public function goMainAdmin()
    {
            $data = Partido::findAll();
            echo $this->twig->render("showAdmin.php.twig", ['data' => $data]);
        
    }

    public function logout()
    {
        $ses = Sesion::getInstance();
        $ses->close();
        $ses->redirect("index.php");
    }

}
