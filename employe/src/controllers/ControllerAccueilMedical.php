<?php
session_start(); // Démarrer la session

class ControllerAccueilMedical
{

    public function __construct($url)
    {
        // Vérifier si les variables de session 'nom' et 'prenom' sont présentes
        if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            header('Location: index.php');
            exit(); // Arrêter l'exécution du script
        }
        if (isset($url) && is_array($url) && count($url) > 1)
            throw new Exception('Page introuvable');
        else {
            if (isset($_GET['id_user'])) {
                $this->patient();
            } else {
                $this->patients();
            }
        }
    }

    public function patients()
{
    $recuperation = new ModeleRecupererPatientNoSQL();
    $prenom = "";
    $nom = "";
    $num_sec = "";
    $date_naissance = "";
    $service = 1;

    if (isset($_POST['chercher'])) {
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : "";
        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : "";
        $date_naissance = isset($_POST['dateNaissance']) ? htmlspecialchars($_POST['dateNaissance']) : "";
        $num_sec = isset($_POST['num_sec']) ? htmlspecialchars($_POST['num_sec']) : "";
    }

    $tab_patient = $recuperation->recupererPatientsNoSQL($nom, $prenom, $date_naissance, $num_sec, $service);

    
    //echo "<pre>";
    //print_r($tab_patient);
    //echo "</pre>";
    
    require_once('src/views/viewAccueilMedical.php');
}


    public function patient()
    {
        $recuperation = new ModeleRecupererUnPatientNoSQL();
        $id_user = htmlspecialchars($_GET['id_user']);
        $service = 1;
        $tab_patient = $recuperation->recupererUnPatientNoSQL($service, $id_user);
        print_r($tab_patient);
    }
}
