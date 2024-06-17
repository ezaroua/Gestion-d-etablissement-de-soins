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

            error_log("Patient ID: $patientId, Date: $date, Motif: $motif, Compte Rendu: $compteRendu, nom_medecin: $nom_medecin");

            $this->saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin );
        } else {
            $this->showForm();
        }
    }

    public function saveCompteRendu($patientId, $date, $motif, $compteRendu, $nom_medecin)
    {
        // Logique de sauvegarde de compte rendu
        $result = $this->_model->creerDansNoSQL($patientId, $date, $motif, $compteRendu, $nom_medecin);
        error_log("Result of insertion: $result");

        // Redirection
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
