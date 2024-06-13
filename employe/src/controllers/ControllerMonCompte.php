<?php
session_start();
require_once 'src/models/ModelMonCompte.php'; // Assurez-vous d'inclure votre modèle

class ControllerMonCompte {
    private $model;

    public function __construct($url) {
        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        // et gérez-les ou lancez une exception si l'URL n'est pas valide
        if (isset($url) && is_array($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }

        // Instancier le modèle
        $this->model = new ModelMonCompte(Database::getBdd());

        // Afficher le formulaire
        $this->afficherFormulaireMonCompte();
    }

    public function afficherFormulaireMonCompte() {
        // Récupération des informations de l'utilisateur
        $userInfo = $this->model->getUserInfo($_SESSION['id_user']);

        // Appel à la vue avec les données utilisateur
        require 'src/views/ViewMonCompte.php';
    }
}
?>
