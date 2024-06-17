<?php
require_once('config.php'); 
require_once(BASE_PATH . '/src/models/ModelRecupererCompteRendu.php');

class ControllerSuiviMedical {
    private $model;

    public function __construct() {
        $this->model = new ModelRecupererCompteRendu();
        $this->main();
    }

    public function main() {
        $patientId = $_GET['patientId'] ?? 'default_id'; 
        $service = $_GET['service'] ?? null; // Récupération du service depuis la requête GET

        // Passer le patientId et le service au modèle
        $comptesRendus = $this->model->recupererComptesRendus($patientId, $service);
        require_once(BASE_PATH . '/src/views/ViewSuiviMedical.php');
    }
}

new ControllerSuiviMedical();
