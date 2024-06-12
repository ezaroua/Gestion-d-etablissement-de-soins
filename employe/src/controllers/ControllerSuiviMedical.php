<?php
require_once('config.php'); // Assurez-vous que ce chemin est correct pour accéder à votre fichier de configuration
require_once(BASE_PATH . '/src/models/ModelRecupererCompteRendu.php');

class ControllerSuiviMedical {
    private $model;

    public function __construct() {
        $this->model = new ModelRecupererCompteRendu();
        $this->main();
    }

    public function main() {
        $patientId = $_GET['patientId'] ?? 'default_id'; // Fallback if not set
        $comptesRendus = $this->model->recupererComptesRendus($patientId);
        require_once(BASE_PATH . '/src/views/ViewSuiviMedical.php');
    }
}

new ControllerSuiviMedical(); // This will initiate the controller
