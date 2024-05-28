<?php

class ControllerSuiviMedical
{
    private $_view;
    private $_service;

    public function __construct($url)
    {
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->suiviMedical($url);
    }

    private function suiviMedical($url)
    {
        $patientId = $_GET['patientId'] ?? null;

        if ($patientId) {
            // Logique pour récupérer les informations de suivi médical pour le patient avec l'id $patientId
            // Par exemple :
            // $this->_service = new SuiviMedicalService();
            // $data = $this->_service->getSuiviMedical($patientId);
            // require_once "src/views/ViewSuiviMedical.php";
            require_once "src/views/ViewSuiviMedical.php";
        } else {
            throw new Exception('Patient ID non fourni');
        }
    }
}

?>
