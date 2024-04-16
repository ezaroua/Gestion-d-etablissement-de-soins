<?php
class ControllerAccueil
{

    private $_patientManager;
    private $_view;

    public function __construct($url)
    {
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->patients();
    }

    private function patients()
    {
        $this->_patientManager = new PatientManager;
        $patients = $this->_patientManager->getPatients();

        // Pass $patients to the view
        $data = ['patients' => $patients];
        extract($data);

        require_once('src/views/viewAccueil.php');
    }
}
