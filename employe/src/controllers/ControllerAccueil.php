<?php

session_start();
// SECURITE DE CONNEXION A LA PAGE
if (isset ($_SESSION['mail'])) 
{
    header('Location: ?url=ConnexionEmploye');
}

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

    public function patients(){
        $this->_patientManager = new PatientManager;
        $patients = $this->_patientManager->searchPatients();
        require_once('src/views/viewAccueil.php');
    }
    
}

?>
