<?php
session_start();
require_once 'src/models/ModelModificationPatient.php'; // Assurez-vous d'inclure votre modèle

class ControllerModificationPatient
{
    private $model;
    private $modelNOsql;
    
    public function __construct($url)
    {
        // Vérifiez si les variables de session 'nom' et 'prenom' sont présentes
        if (!isset($_SESSION['nom']) || !isset($_SESSION['prenom'])) {
            // Rediriger vers une page de connexion ou afficher un message d'erreur
            header('Location: index.php');
            exit(); // Arrêter l'exécution du script
        }

        if  ($_SESSION['id_service'] != 1){

            header('Location: ?url=AccueilMedical');
            exit();

        }

        // Vérifiez si des paramètres supplémentaires sont fournis dans l'URL
        if (isset($url) && is_array($url) && count($url) > 1) {
            throw new Exception('Page introuvable');
        }

        // Vérifiez si l'URL contient au moins un paramètre
        if (isset($_GET['id'])) {
            // Instancier le modèle
            $this->model = new ModelModificationPatient(Database::getBdd());

            // Récupérer l'ID du patient depuis les paramètres de l'URL
            $patientId = $_GET['id'];

            // Si le formulaire est soumis, vérifiez si le bouton "Modifier" est cliqué
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
                // Récupérez les données du formulaire
                $patientData = [
                    'prenom' => htmlspecialchars($_POST['prenom']),
                    'nom' => htmlspecialchars($_POST['nom']),
                    'mail' => htmlspecialchars($_POST['mail']),
                    'sexe' => htmlspecialchars($_POST['sexe']),
                    'date_naissance' => htmlspecialchars($_POST['date_naissance']),
                    'adresse_postale' => htmlspecialchars($_POST['adresse_postale']),
                    'cp' => htmlspecialchars($_POST['cp']),
                    'ville' => htmlspecialchars($_POST['ville']),
                    'pays' => htmlspecialchars($_POST['pays']),
                    'profession' => htmlspecialchars($_POST['profession']),
                    'situation_familiale' => htmlspecialchars($_POST['situation_familiale']),
                    'numero_telephone' => htmlspecialchars($_POST['numero_telephone']),
                    'langue_parlee' => htmlspecialchars($_POST['langue_parlee']),
                    'numero_secu' => htmlspecialchars($_POST['numero_secu']),
                    'type_assurance' => htmlspecialchars($_POST['type_assurance']),
                    'medecin_traitant' => htmlspecialchars($_POST['medecin_traitant']),
                    'personne_urgence' => htmlspecialchars($_POST['personne_urgence']),
                    'tel_cas_urgence' => htmlspecialchars($_POST['tel_cas_urgence']),
                    'lien_urgence' => htmlspecialchars($_POST['lien_urgence'])
                ];

                // Appel à la méthode pour mettre à jour les informations du patient
                $this->model->updatePatientInfo($patientId, $patientData);
                $this->model->modifierDansNoSQL($patientId, $patientData['prenom'], $patientData['nom'], $patientData['mail'], $patientData['sexe'], $patientData['date_naissance'], $patientData['adresse_postale'], $patientData['cp'], $patientData['ville'], $patientData['pays'], $patientData['profession'], $patientData['situation_familiale'], $patientData['numero_telephone'], $patientData['langue_parlee'], $patientData['numero_secu'], $patientData['type_assurance'], $patientData['medecin_traitant'], $patientData['personne_urgence'], $patientData['tel_cas_urgence'], $patientData['lien_urgence']);
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inserer'])) {
                $service = htmlspecialchars($_POST['service']);
                $this->model->insererServicePatient($patientId, $service);

                $result = $this->model->recupererDonneePatient($patientId);
                foreach ($result as $result) {
                    $num_secu = $result['num_sec'];
                    $date_naissance = $result['date_naissance'];
                    $profession = $result['profession'];
                    $situation_familial = $result['situation_familial'];
                    $adresse = $result['adresse_postal'];
                    $cp = $result['CP'];
                    $ville = $result['Ville'];
                    $pays = $result['Pays'];
                    $tel = $result['num_tel'];
                    $type_assurance = $result['type_assurance'];
                    $contacte_cas_urgence = isset($result['contacte_cas_urgence']) ? $result['contacte_cas_urgence'] : '';
                    $telephone_cas_urgence = isset($result['telephone_cas_urgence']) ? $result['telephone_cas_urgence'] : '';
                    $lien_cas_urgence = isset($result['lien_cas_urgence']) ? $result['lien_cas_urgence'] : '';
                    $medecin_traitant = $result['MedecinTraitant'];
                    $langue = $result['langue_parler'];
                }
                $result2 = $this->model->recupererDonneeUser($patientId);
                foreach ($result2 as $result) {
                    $nom = $result['Nom_user'];
                    $prenom = $result['prenom_user'];
                    $sexe = $result['sexe'];
                    $mail = $result['adresse_mail'];
                }
                $this->model->creerDansNoSQL($nom, $prenom, $sexe, $mail, $date_naissance, $profession, $situation_familial, $num_secu, $adresse, $cp, $ville, $pays, $tel, $type_assurance, $contacte_cas_urgence, $telephone_cas_urgence, $lien_cas_urgence, $medecin_traitant, $langue, $patientId, $service);
            } else {
                // Appel à la méthode afficherFormulaire avec l'ID du patient
                $this->afficherFormulairePatient($patientId);
            }
        } else {
            // Si aucun ID de patient n'est fourni, vous pouvez gérer cela ici (par exemple, rediriger vers une page d'erreur)
            throw new Exception('ID de patient non spécifié');
        }
    }


    public function afficherFormulairePatient($patientId)
    {
        // Récupération des informations du patient
        $patientInfo = $this->model->getPatientInfo($patientId);
        $patientService = $this->model->recupererServicePatient($patientId);

        // Vérifie si le patient existe
        if ($patientInfo) {
            // Appel à la vue avec les données du patient
            require 'src/views/ViewModificationPatient.php';
        } else {
            // Si le patient n'existe pas, vous pouvez gérer cela ici (par exemple, rediriger vers une page d'erreur)
            throw new Exception('Patient introuvable');
        }
    }
}
