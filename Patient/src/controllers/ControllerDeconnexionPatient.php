<?php 

class ControllerDeconnexionPatient {

    private $_view;

    public function __construct($url)
    {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
            $this->Deconnexion();
    }


    public function Deconnexion() { //A FAIRE FONCTIONNER
        session_destroy();
        header('Location: ?url=ConnexionPatient'); // Redirige vers la page de connexion

        //echo "<script language='Javascript'>alert('$error')</script>";
        //header("Refresh: 0.1; " . $_SERVER['REQUEST_URI']);
        exit();
        }
}

?>
