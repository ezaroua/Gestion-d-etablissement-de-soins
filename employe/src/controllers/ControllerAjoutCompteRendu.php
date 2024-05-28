<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class ControllerAjoutCompteRendu
{
    private $_patientManager;

    public function __construct($url)
    {
        $this->_patientManager = new PatientManager();
        $this->showAjoutCompteRenduForm();
    }

    private function showAjoutCompteRenduForm()
    {
       

        $patientId = $_GET['patientId'] ?? null;

        if ($patientId) {
            // Logique pour récupérer les informations de suivi médical pour le patient avec l'id $patientId
            // Par exemple :
            // $this->_service = new SuiviMedicalService();
            // $data = $this->_service->getSuiviMedical($patientId);
            // require_once "src/views/ViewSuiviMedical.php";
            require_once('src/views/ViewAjoutCompteRendu.php');
        } else {
            throw new Exception('Patient ID non fourni');
        }
    }
}
?>
