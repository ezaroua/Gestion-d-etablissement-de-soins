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
            $patientId = $_POST['patientId'];
            $date = $_POST['date'];
            $motif = $_POST['motif'];
            $compteRendu = $_POST['compteRendu'];
            $nom_medecin = $_SESSION['nom'] ." ". $_SESSION['prenom'];
            echo ($nom_medecin);

            error_log("Patient ID: $patientId, Date: $date, Motif: $motif, Compte Rendu: $compteRendu, nom_medecin: $nom_medecin");

            $this->saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin );
        } else {
            $this->showForm();
        }
    }


    public function saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin)
    {
        // Log to see when saveCompteRendu is called
        error_log("saveCompteRendu called with patientId: $patientId, date: $date, motif: $motif, nom_medecin: $nom_medecin");
        
        $result = $this->_model->creerDansNoSQL($patientId, $date, $motif, $compteRendu,$nom_medecin );
        // Log result of the insertion
        error_log("Result of insertion: $result");

        // Redirect to the follow-up page
        header('Location: ?url=SuiviMedical&patientId=' . urlencode($patientId));
        exit();
    }

    public function showForm()
    {
        // Inclure la vue pour le formulaire d'ajout de compte rendu
        require_once('src/views/ViewAjoutCompteRendu.php');
    }
}

// Exemple d'utilisation du contrôleur
$controller = new ControllerAjoutCompteRendu();
?>
