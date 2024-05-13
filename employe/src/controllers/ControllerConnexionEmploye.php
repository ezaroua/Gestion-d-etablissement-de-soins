<?php
class ControllerConnexionEmploye
{
    private $_model;

    public function __construct()
    {
        $this->_model = new ModelConnexionEmploye();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Envoyer'])) {
            $this->handleLogin();
        } else {
            $this->showLoginForm();
        }
    }

    private function handleLogin()
    {
        $mail = htmlspecialchars($_POST['mail']); // Pour éviter les injections XSS
        $password = htmlspecialchars($_POST['password']);

        $connexion_result = $this->_model->connexionEmploye($mail, $password);

        if ($connexion_result['success']) {
            $_SESSION['mail'] = $connexion_result['user']['adresse_mail'];
            $_SESSION['statut'] = $connexion_result['statut'];
            header('Location: ./../views/ViewAccueil.php');
            exit();
        } else {
            $error = $connexion_result['error'];
            session_destroy();
            echo "<script language='Javascript'>alert('$error')</script>";
            header('Refresh: 0.1; ./../views/ViewConnexionEmploye.php');
            exit();
        }
    }

    private function showLoginForm()
    {
        // Afficher le formulaire de connexion
        require_once "./../views/ViewConnexionEmploye.php";
    }
}
?>
