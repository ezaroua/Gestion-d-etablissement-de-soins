<?php
require_once('src/models/ModelVoirCompteRendu.php');

class ControllerSuiviMedical {
    private $model;

    public function __construct() {
        $this->model = new ModelVoirCompteRendu();
    }

    public function main() {
        if (!isset($_GET['patientId'])) {
            $this->redirectWithError("ID utilisateur non spécifié.");
        }
    
        $patientId = htmlspecialchars($_GET['patientId']);
        $comptesRendus = $this->model->recupererComptesRendus($patientId);
    
        error_log("Comptes Rendus fetched: " . print_r($comptesRendus, true));
    
        if (empty($comptesRendus)) {
            $this->redirectWithError("Aucun compte rendu disponible pour cet utilisateur.");
        }
    
        include('src/views/ViewSuiviMedical.php');
    }

    private function redirectWithError($message) {
        $_SESSION['error'] = $message;
        header("Location: errorPage.php"); // Assurez-vous que cette redirection est appropriée
        exit();
    }
}
