<?php
session_start();
require_once('src/models/ModelVoirCompteRendu.php');

class ControllerVoirCompteRendu {
    private $model;

    public function __construct($url) {
        $this->model = new ModelVoirCompteRendu();
        if (isset($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        } else {
            $this->voirDetails();
        }
    }

    public function voirDetails() {
        if (!isset($_GET['consultationId']) || !isset($_GET['patientId'])) {
            die('Consultation ID and Patient ID are required');
        }

        $consultationId = (int) $_GET['consultationId'];
        $patientId = $_GET['patientId']; // Assurez-vous de sécuriser et de valider cet ID avant utilisation
        $consultation = $this->model->getConsultationById($patientId, $consultationId);

        if ($consultation === null) {
            die('Aucune consultation trouvée avec cet ID');
        }

        require_once('src/views/ViewVoirCompteRendu.php');
    }
}
