<?php
session_start();
require_once('src/models/ModelAjoutCompteRendu.php');

class ControllerAjoutCompteRendu
{
    private $_model;

    public function __construct()
    {
        $this->_model = new ModelAjoutCompteRendu();
        $this->handleRequest();
    }

    public function handleRequest()
    {
        if (isset($_POST['submit'])) {
            error_log("Form submitted");

            // Nettoyage des données reçues via POST
            $patientId = htmlspecialchars($_POST['patientId'], ENT_QUOTES, 'UTF-8');
            $date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
            $motif = htmlspecialchars($_POST['motif'], ENT_QUOTES, 'UTF-8');
            $compteRendu = htmlspecialchars($_POST['compteRendu'], ENT_QUOTES, 'UTF-8');
            $nom_medecin = htmlspecialchars($_SESSION['nom'] . " " . $_SESSION['prenom'], ENT_QUOTES, 'UTF-8');
            $id_service = htmlspecialchars($_SESSION['id_service'], ENT_QUOTES, 'UTF-8');
            $nom = $_GET['nom'] ?? 'Unknown';  
            
            error_log("Patient ID: $patientId, Date: $date, Motif: $motif, Compte Rendu: $compteRendu, nom_medecin: $nom_medecin, id_service: $id_service");

            $this->saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin, $id_service, $nom);
        } else {
            $this->showForm();
        }
    }

    public function saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin, $id_service, $nom)
    {
        
        $result = $this->_model->creerDansNoSQL($patientId, $date, $motif, $compteRendu, $nom_medecin, $id_service);
        error_log("Result of insertion: $result");

     
        header('Location: ?url=SuiviMedical&patientId=' . urlencode($patientId) . '&nom=' . urlencode($nom));
        exit();
    }

    public function showForm()
    {
        // Include the view for adding a medical report
        require_once('src/views/ViewAjoutCompteRendu.php');
    }
}

// Instance of the controller
$controller = new ControllerAjoutCompteRendu();
?>
