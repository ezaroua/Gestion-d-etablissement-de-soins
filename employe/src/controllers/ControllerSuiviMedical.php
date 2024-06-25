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
        $service = $_GET['service'] ?? null;
        $nom = $_GET['nom'] ?? 'Inconnu';
        $comptesRendus = $this->model->recupererComptesRendus($patientId, $service);
        require_once(BASE_PATH . '/src/views/ViewSuiviMedical.php');
    }
}

new ControllerSuiviMedical();
