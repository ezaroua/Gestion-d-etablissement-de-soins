<?php
session_start(); // Démarrer la session
class ControllerAccueilPatient
{

    public function __construct($url)
    {
        // Vérifier si les variables de session 'nom' et 'prenom' sont présentes
        if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            header('Location: index.php');
            exit(); // Arrêter l'exécution du script
        }
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else {
            if (isset($_GET['id_user'])) {
                $this->patient();
            } else {
                $this->patients();
            }
        }
    }

    public function patients()
    {
        require_once('src/views/viewAccueilPatient.php');
    }
}
