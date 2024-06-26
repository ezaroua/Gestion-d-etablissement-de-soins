<?php
session_start();
class ControllerConnexionPatient
{
    private $_model;
    private $_view;

    
    public function __construct($bdd)
    {
        // Initialise le modèle avec une instance PDO
        $this->_model = new ModelConnexionPatient(Database::getBdd());
        $this->handleRequest();
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

        $connexion_result = $this->_model->connexionPatient($mail, $password);


        if ($connexion_result['success']) {
            $_SESSION['mail'] = $connexion_result['adresse_mail'];
            $_SESSION['statut'] = $connexion_result['statut'];
        }

        if ($connexion_result['success']) { //On instencie les variables de session
            $_SESSION['mail'] = $mail;
            $_SESSION['nom'] = $connexion_result['nom'];
            $_SESSION['prenom'] = $connexion_result['prenom'];
            $_SESSION['id_user'] = $connexion_result['id_user'];


                header('Location: ?url=AccueilPatient');
                exit();

        } else {
            $error = $connexion_result['error'];
            // Vérifie si une session est active avant de la détruire
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
            }

            echo "<script language='Javascript'>alert('$error')</script>";
            header("Refresh: 0.1; " . $_SERVER['REQUEST_URI']);
            exit();
        }
    }

    private function showLoginForm()
    {
        // Afficher le formulaire de connexion
        require_once "src/views/ViewConnexionPatient.php";
    }
}