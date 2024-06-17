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
        $consultation_id = $_GET['consultation_id'] ?? 'default_id'; 
        $comptesRendus = $this->model->recupererComptesRendus($patientId);
        require_once(BASE_PATH . '/src/views/ViewSuiviMedical.php');
    }
}

new ControllerSuiviMedical(); 
